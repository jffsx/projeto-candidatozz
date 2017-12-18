<?php

namespace Candidatozz\Domains\Candidates\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Candidatozz\Support\Http\Controllers\Controller;
use Candidatozz\Support\Database\Repository\ModelNotFoundException;
use Candidatozz\Domains\Candidates\Contracts\CandidateServiceContract;

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
        return $this->candidateService->paginate();
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
                'email' => 'required|email|unique:candidates',
                'gender' => 'required',
            ],[
                'first_name.required' => 'Nome obrigatório.',
                'last_name.required' => 'Sobrenome obrigatório.',
                'email.required' => 'E-mail é obrigatório.',
                'email.email' => 'E-mail inválido.',
                'email.unique' => 'E-mail já cadastrado.',
                'gender.required' => 'Sexo é obrigatório',
            ]);

            $candidate = $this->candidateService->create($request->all());
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

            return $this->candidateService->find($id);

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
            ],[
                'first_name.required' => 'Nome obrigatório.',
                'last_name.required' => 'Sobrenome obrigatório.',
                'email.required' => 'E-mail é obrigatório.',
                'email.email' => 'E-mail inválido.',
                'gender.required' => 'Sexo é obrigatório',
            ]);

            $candidate = $this->candidateService->update($request->all(), $id);
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
