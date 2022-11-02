<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Mongodb\Auth\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Carga la página de inicio del objeto
        $products = Product :: where ('state', '=', 'A') -> get() ;
        $cont = Product::count();
        $productsT = $this->cargarDT($products);
        return view(view:'products.index')-> with('products', $productsT)->with('cont', $cont);
    }

    public function cargarDT($consulta)
    {
        $products = [];

        foreach ($consulta as $key => $value){

            $ruta = "eliminar".$value['id'];
            $eliminar = route('delete-product', $value['id']);

            $actualizar =  route('products.edit', $value['id']);
            $detalle =  route('products.show', $value['id']);
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
                            <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este producto?</h5>
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
            $products[$key] = array(
                $acciones,
                $value['id'],
                $value['shelf_id'],
                $value['name']
            );

        }

        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // mostrar el formulario de captura
        return view('products.create');
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
            'shelf_id' => 'required|min:1',
            'name' => 'required|min:5'
        ]);
        $product = new Product();
        $product->shelf_id = $request->input(key:'shelf_id');
        $product->name = $request->input(key:'name');
        $product->weight = $request->input(key:'weight');
        $product->state = $request->input(key:'state');
        $product->stockmin = $request->input(key:'stockmin');
        $product->stockmax = $request->input(key:'stockmax');
        $product->quantity = $request->input(key:'quantity');
        $product->save();
        return redirect()->route(route: 'products.index')->with(array(
            'message' => 'El producto se ha creado correctamente'
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
        $product = Product::find($id);
        return view(view: 'products.show')->with('product',$product);
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
        $product = Product::find($id);
        if ($user) {
            return view('products.edit', array('product' => $product));
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
            'shelf_id' => 'required|min:1',
            'name' => 'required|min:5'
        ]);
        $product = Product::find($id);
        $product->shelf_id = $request->input(key:'shelf_id');
        $product->name = $request->input(key:'name');
        $product->weight = $request->input(key:'weight');
        $product->state = $request->input(key:'state');
        $product->stockmin = $request->input(key:'stockmin');
        $product->stockmax = $request->input(key:'stockmax');
        $product->quantity = $request->input(key:'quantity');

        $product->update();
        return redirect()->route(route: 'products.index')->with(array(
            'message' => 'El producto se ha actualizado correctamente'
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

    public function delete_product($product_id)
    {
        $product = Product::find($product_id);
        if ($product) {
            $product->state = 0;
            $product->update();
            return redirect()->route('products.index')->with(array(
                "message" => "El producto se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('products.index')->with(array(
                "message" => "El producto que trata de eliminar no existe"
            ));
        }
    }
}
