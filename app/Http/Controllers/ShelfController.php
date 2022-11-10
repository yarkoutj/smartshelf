<?php

namespace App\Http\Controllers;

use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Auth\User;

class ShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Carga la página de inicio del objeto
        $shelfs = Shelf :: where ('code', '!=', 'Eliminado') -> get() ;
        $cont = Shelf::count();
        $shelfsT = $this->cargarDT($shelfs);
        return view(view:'shelfs.index')-> with('shelfs', $shelfsT)->with('cont', $cont);
    }

    public function cargarDT($consulta)
    {
        $shelfs = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-shelf', $value['id']);

            $actualizar =  route('shelfs.edit', $value['id']);
            $detalle =  route('shelfs.show', $value['id']);
            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle">
                        <a href="'.$actualizar. '" role="button" class="btn btn-success" title="actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="' . $detalle . '" role="button" class="btn btn-primary" title="visualizar">
                            <i class="far fa-play"></i>
                        </a>
                         <a href="#'.$actualizar.'" role="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#'.$ruta.'">
                            <i class="far fa-trash-alt"></i>
                        </a>

                    </div>
                </div>
<!-- Modal -->
            <div class="modal fade" id="'.$ruta.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este estante?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-primary">
                        <small>
                            '.$value['id'].', '.$value['name'].'                 </small>
                      </p>
</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                      <a href="'.$eliminar.'" type="button" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>

            ';
            $shelfs[$key] = array(
                $acciones,
                $value['id'],
                $value['ubication'],
                $value['code']
            );

        }

        return $shelfs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mostrar el formulario de captura
        $user = Auth::user();
        if ($user) {
            return view('shelfs.create');
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //guarda un nuevo registro apartir de un formulario de nuevo registro
        //validacion del formulario
        $validateData = $this->validate($request, [
            'ubication' => 'required|min:2',
            'code' => 'required|min:1'
        ]);
        $shelf = new Shelf();
        $shelf->ubication = $request->input(key:'ubication');
        $shelf->code = $request->input(key:'code');
        $shelf->save();
        return redirect()->route(route: 'shelfs.index')->with(array(
            'message' => 'El estante se ha creado correctamente'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //muestra un registro solamente
        $shelf = Shelf::find($id);
        return view(view: 'shelfs.show')->with('shelf',$shelf);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //abri el formulario de edicion
        $user = Auth::user();
        $shelf = Shelf::find($id);
        if ($user) {
            return view('shelfs.edit', array('shelf' => $shelf));
        } else {
            return redirect()->route('home');
        }
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
        //guarda la modificacion de una edicion
        $validateData = $this->validate($request, [
            'ubication' => 'required|min:2',
            'code' => 'required|min:1'
        ]);
        $shelf = Shelf::find($id);
        $shelf->ubication = $request->input(key:'ubication');
        $shelf->code = $request->input(key:'code');

        $shelf->update();
        return redirect()->route(route: 'shelfs.index')->with(array(
            'message' => 'El estante se ha actualizado correctamente'
        ));
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

    public function delete_shelf($shelf_id)
    {
        $user = Auth::user();
        $shelf = Shelf::find($shelf_id);
        if ($shelf && $user) {
            $shelf->code = 'Eliminado';
            $shelf->update();
            return redirect()->route('shelfs.index')->with(array(
                "message" => "El estante se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('shelfs.index')->with(array(
                "message" => "El estante que trata de eliminar no existe o no tiene permiso"
            ));
        }
    }
}
