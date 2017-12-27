<?php

namespace Candidatozz\Domains\Candidates\Http\Controllers;

use Storage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Candidatozz\Support\Http\Controllers\Controller;
use Candidatozz\Support\Database\Repository\ModelNotFoundException;
use Candidatozz\Domains\Candidates\Contracts\CandidateServiceContract;
use Candidatozz\Domains\Candidates\Transformers\CandidateTransformer;
use Candidatozz\Domains\Candidates\Models\Candidate;

class CandidateController extends Controller
{
    /**
     * Candidate service.
     *
     * @var CandidateServiceContract
     */
    protected $candidateService;

    /**
     * Create a new controller instance.
     *
     * @param CandidateServiceContract $candidateService
     * @return void
     */
    public function __construct(CandidateServiceContract $candidateService)
    {
        $this->candidateService = $candidateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index', Candidate::class);

        return $this->response()->collection($this->candidateService->paginate(), new CandidateTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Candidate::class);

        try {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:candidates',
                'gender' => 'required',
            ],[
                'first_name.required' => 'Nome obrigatório.',
                'last_name.required' => 'Sobrenome obrigatório.',
                'email.required' => 'E-mail é obrigatório.',
                'email.email' => 'E-mail inválido.',
                'email.unique' => 'E-mail já encontra-se cadastrado.',
                'gender.required' => 'Sexo é obrigatório.',
            ]);

            $candidate = $this->candidateService->create($request->except('curriculum_vitae'));

            if ($request->file('curriculum_vitae')) {
                $this->candidateService->saveCurriculum($request->file('curriculum_vitae'), $candidate->id);
            }

            return $this->response()->withSuccess('Candidato criado com sucesso');

        } catch (ValidationException $e) {
            return $this->response()->withUnprocessableEntity($e->errors());
        } catch (Exception $e) {
            return $this->response()->withError('Ocorreu um erro ao criar o candidato' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = $this->candidateService->find($id);
        $this->authorize('show', $candidate);

        try {

            return $this->response()->item($candidate, new CandidateTransformer);

        } catch (ModelNotFoundException $e) {
            return $this->response()->withError($e->getMessage());
        } catch (Exception $e) {
            return $this->response()->withError('Ocorreu um erro ao buscar o candidato');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Candidate::class);

        try {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'birth_date' => 'required|before:16 years ago',
                'curriculum_vitae' => 'required_if:has_curriculum_vitae,false|mimes:doc,docx,pdf',
            ],[
                'first_name.required' => 'Nome obrigatório.',
                'last_name.required' => 'Sobrenome obrigatório.',
                'email.required' => 'E-mail é obrigatório.',
                'email.email' => 'E-mail inválido.',
                'gender.required' => 'Sexo é obrigatório.',
                'birth_date.required' => 'Data de nascimento é obrigatório.',
                'birth_date.before' => 'O candidato precisa ter no mínimo 16 anos.',
                'curriculum_vitae.required_if' => 'Por favor, envie o currículo.',
                'curriculum_vitae.mimes' => 'Só é aceito currívulos nos formatos doc, docx ou pdf.',
            ]);

            $candidate = $this->candidateService->update($request->except('curriculum_vitae'), $id);

            if ($request->file('curriculum_vitae')) {
                $this->candidateService->saveCurriculum($request->file('curriculum_vitae'), $id);
            }

            return $this->response()->withSuccess('Candidato atualizado com sucesso');

        } catch (ValidationException $e) {
            return $this->response()->withUnprocessableEntity($e->errors());
        } catch (ModelNotFoundException $e) {
            return $this->response()->withError($e->getMessage());
        } catch (Exception $e) {
            return $this->response()->withError('Ocorreu um erro ao atualizar o candidato');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Candidate::class);

        try {

            $candidate = $this->candidateService->delete($id);
            return $this->response()->withSuccess('Candidato deletado com sucesso');

        } catch (ModelNotFoundException $e) {
            return $this->response()->withError($e->getMessage());
        } catch (Exception $e) {
            return $this->response()->withError('Ocorreu um erro ao deletar o candidato');
        }
    }

    /**
     * Curriculum download
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function curriculumDownload($id)
    {
        $candidate  = $this->candidateService->find($id);
        $this->authorize('curriculum-download', $candidate);

        try {
            $path = Storage::path($candidate->curriculum_vitae);

            return response()->download($path);

        } catch (Exception $e) {
            return $this->response()->withError('Ocorreu um erro ao deletar o candidato');
        }
    }
}
