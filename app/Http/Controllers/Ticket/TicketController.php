<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTickets;
use App\Models\Camiones;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
         $tickets = Ticket::with('camion.conductor')->get();



        return view('Tickets.Gestion',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $conductores = User::where('id_asignacion',1)->get();
        
        return view('Tickets.Registro',compact('conductores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTickets $request)
    {
      
        $rutaDestino = public_path('img/'); // Esto crea la ruta completa a la carpeta public/img
        $nombreArchivo = $request->file('archivo')->getClientOriginalName();
        $request->file('archivo')->move($rutaDestino, $nombreArchivo);

        $idcamion = Camiones::where('id_conductor' , $request->conductor)->first();

        $ticket = Ticket::create([
            'radicado' => $request->radicado,
            'fecha' => $request->fecha,
            'hora'=> $request->hora,
            'procedencia' =>$request->procedencia,
            'destino' => $request->destino,
            'despachador' => $request->despachador,
            'id_conductor'  => $idcamion->id,
            'pesoBruto' => $request->pesoBruto,
            'pesoTara' => $request->pesoTara,
            'pesoNeto' => $request->pesoNeto,
            'recibido' => $request->recibido,
            'fototicket' => $request->fotonombre,

        ]);


        Session::flash('success', 'El Ticket se Registro exitosamente');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
