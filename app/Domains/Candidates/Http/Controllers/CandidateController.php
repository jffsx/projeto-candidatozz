<?php

namespace Candidatozz\Domains\Candidates\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Candidatozz\Support\Http\Controllers\Controller;
use Candidatozz\Support\Database\Repository\ModelNotFoundException;
use Candidatozz\Domains\Candidates\Contracts\CandidateServiceContract;
use Candidatozz\Domains\Candidates\Transformers\CandidateTransform;

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
        return $this->response()->collection($this->candidateService->paginate(), new CandidateTransform);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'curriculum_vitae' => 'required|mimes:doc,docx,pdf',
            ],[
                'first_name.required' => 'Nome obrigatório.',
                'last_name.required' => 'Sobrenome obrigatório.',
                'email.required' => 'E-mail é obrigatório.',
                'email.email' => 'E-mail inválido.',
                'gender.required' => 'Sexo é obrigatório.',
                'curriculum_vitae.required' => 'Por favor envie seu currículo.',
                'curriculum_vitae.mimes' => 'Só é aceito currívulos nos formatos doc, docx ou pdf.',
            ]);

            $candidate = $this->candidateService->create($request->all());
            $this->candidateService->saveCurriculum($request->file('curriculum_vitae'), $candidate->id);

            return $this->response()->withSuccess('Candidato criado com sucesso');

        } catch (ValidationException $e) {
            return $this->response()->withUnprocessableEntity($e->errors());
        } catch (Exception $e) {
            return $this->response()->withError('Ocorreu um erro ao criar o candidato');
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
        try {

            return $this->response()->item($this->candidateService->find($id), new CandidateTransform);

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
        try {
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'gender' => 'required',
                'birth_date' => 'required|before:16 years ago',
                'curriculum_vitae' => 'required_if:has_curriculum_vitae,false|sometimes|mimes:doc,docx,pdf',
            ],[
                'first_name.required' => 'Nome obrigatório.',
                'last_name.required' => 'Sobrenome obrigatório.',
                'email.required' => 'E-mail é obrigatório.',
                'email.email' => 'E-mail inválido.',
                'gender.required' => 'Sexo é obrigatório.',
                'birth_date.required' => 'Data de nascimento é obrigatório.',
                'birth_date.before' => 'O candidato precisa ter no mínimo 16 anos.',
                'curriculum_vitae.required_if' => 'Por favor envie seu currículo.',
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
            return $this->response()->withError('Ocorreu um erro ao atualizar o candidato' . $e->getMessage());
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
        try {

            $candidate = $this->candidateService->delete($id);
            return $this->response()->withSuccess('Candidato deletado com sucesso');

        } catch (ModelNotFoundException $e) {
            return $this->response()->withError($e->getMessage());
        } catch (Exception $e) {
            return $this->response()->withError('Ocorreu um erro ao deletar o candidato');
        }
    }
}
