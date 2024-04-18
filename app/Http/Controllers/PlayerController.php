<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Storage;


class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /* Sérgio Solution
     * public function index(Request $request)
    {
        $players = ($request->search) ?
            Player::where('name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(10); :
            Player::orderBy('id', 'desc')->paginate(10);

            return view('pages.players.index', ['players' => $players]);
    }
    */

    public function index(Request $request)
    {
        if($request->search) {
            $players = Player::where('name', 'LIKE', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(10);
        }else{
            $players = Player::orderBy('id', 'asc')->paginate(15);
        }
        return view('pages.players.index', ['players' => $players]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required',
            'address'     => 'required',
            'description' => 'required',
            'retired'     => 'required|boolean',
        ]);

        /*Player::create($request->all());*/

        /* Example 2
        $input = $request->all();
        Player::create($input);
        */

        /* Example 3
        Player::create([
        'name'         => $request->name,
        'address'      => $request->address,
        'description'  => $request->description,
        'retired'      => $request->retired
        ]);
        */


        /* Example 4 */
         $player               = new Player();
         $player->name         = $request->name;
         $player->address      = $request->address;
         $player->description  = $request->description;
         $player->retired      = $request->retired;
         $player->save();

        //If we have an image file, we store it, and move it in the database
        if ($request->file('image')) {
            // Get Image File
            $imagePath = $request->file('image');
            // Define Image Name
            $imageName = $player->id . '_' . time() . '_' . $imagePath->getClientOriginalName();
            // Save Image on Storage
            $path = $request->file('image')->storeAs('images/players/' . $player->id, $imageName, 'public');
            //Save Image Path
            $player->image = $path;
        }
        $player->save();

        return redirect('players')->with('status','Player created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return view('pages.players.show', ['player' => $player]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        return view('pages.players.edit', ['player' => $player]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $player->update($request->all());
 
        if ($request->file('image')) {
 
            $imagePath = $request->file('image');
 
            $imageName = $player->id . '_' . time() . '_' . $imagePath->getClientOriginalName();
 
            $path = $request->file('image')->storeAs('images/players/' . $player->id, $imageName, 'public');
            $player->image = $path;
            }
 
        //Player::create($request->all());
        $player->save();
 
        return redirect('players')->with('status', 'Player updated succesfully!');
     }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        // Exclui o diretório de imagens do jogador
        Storage::deleteDirectory('public/images/players/' . $player->id);
        
        // Exclui o jogador do banco de dados
        $player->delete();
    
        // Redireciona de volta para a página de jogadores com uma mensagem de sucesso
        return redirect('players')->with('status','Player deleted successfully!');
    }
    
    /**
     * Truncate all players.
     *
     * @return \Illuminate\Http\Response
     */
    public function truncate()
    {
        // Verificar se o usuário está autenticado
        if (!auth()->check()) {
            // Se não estiver autenticado, redirecione para a página de login
            return redirect()->route('login')->with('error', 'Você precisa estar logado para executar esta ação.');
        }
    
        // Trunca (remove todos os registros) da tabela de jogadores
        Player::truncate();
    
        // Redireciona de volta para a página de jogadores com uma mensagem de sucesso
        return redirect('players')->with('status','All players deleted successfully!');
    }
    
    /**
     * Export all players to Excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        // Exporta todos os jogadores para um arquivo Excel
        return Excel::download(new UsersExport, 'players.xlsx');
    }
    
    /**
     * Import players from Excel file.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        // Get the file from the request
        $file = $request->file('file');

        // Import players from the Excel file
        Excel::import(new UsersImport, $file);

        // Redirect back to the players page with a success message
        return redirect('/players')->with('success', 'All players imported successfully!');
    }
    
}
