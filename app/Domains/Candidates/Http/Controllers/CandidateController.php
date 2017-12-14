<?php

namespace Candidatozz\Domains\Candidates\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Candidatozz\Support\Http\Controllers\Controller;
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
     * @param BannerServiceInterface $bannerService
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
            ]);

            $candidate = $this->candidateService->create($request->all());
            return response()->json(['message' => 'Candidato criado com sucesso.'], 200);

        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao criar o candidato.'], 500);
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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao buscar o candidato.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
            ]);

            $candidate = $this->candidateService->update($request->all(), $id);
            return response()->json(['message' => 'Candidato atualizado com sucesso.'], 200);

        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao atualizar o candidato.' . $e->getMessage()], 500);
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
            return response()->json(['message' => 'Candidato deletado com sucesso.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao deletar o candidato.'], 500);
        }
    }
}
