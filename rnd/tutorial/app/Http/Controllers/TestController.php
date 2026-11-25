<?php

    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Name;
    use App\Models\Family;
    use Exception;
    use Illuminate\Database\QueryException;

    class TestController
    {
       public function test()
    {
        $names = Name::all();
        $randomName = $names->isNotEmpty() ? $names->random()->name : 'Nincs elérhető név';

        return view('pages.test', compact('randomName'));
    }
            

        public function names() 
        {
            $names = Name::all();
            $families = Family::all();
                /* = Name::Find(1);
                   = Name::where('name', 'Jeff')->get();
                   = Name::where('id', '>', 2)->get();
                
                   = Name::where('name', '<>', 'Jeff')
                        ->whereAnd('id', '>', 1)
                        ->orderBy('id', 'desc')
                        ->get();

                */
            return view('pages.names', compact('names', 'families'));
        }
    
        public function familyCreate($name) 
        {
            $familyRecord = new Family();
            $familyRecord->surname = $name;
            $familyRecord->save();
            return $familyRecord->id;
        }

        public function namesCreate($familyId, $name) 
        {
            $nameRecord = new Name();
            $nameRecord->name = $name;
            $nameRecord->family_id = $familyId;
            $nameRecord->save();
            return $nameRecord->id;
        }

        public function namesDelete(Request $request) 
        {
            $name = Name::find($request->input('id'));
            $name->delete();
            return "ok";
            
        }
        
        public function manageSurname()
        {
            $names = Family::all();
            return view('pages.surname', compact('names'));
        }

        public function deleteSurname(Request $request)
        {
            try {
                $name = Family::find($request->input('id'));
                $name->delete();
                return response()->json(['success' => true, 'message' => 'Családnév sikeresen törölve.']);
            }
            catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            
            catch (QueryException $e) {
                return response()->json(['success' => false, 'message' => 'Hiba történt a törlés során.'], 500);
            }
        }

        public function newSurname(Request $request)
        {
            $validatedData = $request->validate([
                'inputFamily' => 'required|alpha|min:2|max:20',
            ]);

            $familyRecord = new Family();
            $familyRecord->surname = $validatedData['inputFamily'];
            $familyRecord->save();
            return redirect("/names/manage/surname");
        }

        public function newName(Request $request)
        {
            $validatedData = $request->validate([
                'inputFamily' => 'required|integer|exists:App\Models\Family,id',
                'inputName' => 'required|alpha|min:2|max:20',
            ]);

            $name = new Name();
            $name->family_id = $validatedData['inputFamily'];
            $name->name = $validatedData['inputName'];
            $name->save(); 
            return redirect("/names");
        }

        /*
        public function returnObject()
        {
            $obj = new stdClass();
            $obj->name = 'Lakatos';
            $obj->server = "szbi.pg";

            return response()->json($obj);
        }

        public function returnError()
        {
            return response()->json("error", ['valtozo' => 'ez egy változó értéke'],404);
        }
        
        public function redirectAway()
        {
            return redirect() ->away('https://szbi-pg.hu');
        }
        */
    }


