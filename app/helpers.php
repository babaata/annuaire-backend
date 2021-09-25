<?php
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use App\Models\{Utilisateur};
use App\Gestions\{GestionUtilisateur};

function update_user(){
	$users = Utilisateur::get();

	$gestion = new GestionUtilisateur();

	foreach ($users as $key => $user) {
		$username = $gestion->createUserName($user->nom, $user->prenom);
		if (!$user->nom_utilisateur) {
			$user->update(['nom_utilisateur' => $username]);
		}

		$user->update(['nom_utilisateur' => $username]);

		if (!$user->url_photo) {
			$user->update(['url_photo' => asset('default.jpg')]);
		}

		$user->update(['url_photo' => asset('default.jpg')]);
	}
}

function create_fk($table, $table_name, $nullable = false){
	if ($nullable) {
		$table->integer("id_$table_name")->nullable();
	}else{
		$table->integer("id_$table_name");
	}
	
    $table->foreign("id_$table_name")->references("id_$table_name")->on($table_name)->onDelete('cascade')->onUpdate('cascade');
}

function send_sms($message, $telephone)
{
	try {
		$client = SMSClient::getInstance(config('app.sms_api_client'), config('app.sms_api_secret'));
		$sms = new SMS($client);
		$sms->message($message)->from('+224627044179')->to($telephone)->send();
		return true;
	} catch (\GuzzleHttp\Exception\ConnectException $e) {
		return false;
	}
}

function models(){
	return [
		"utilisateur",
		"role",
		"droit",
		"adresse",
		"utilisateur_role",
		"role_droit",
		"profil",
		"competence",
		"langue",
		"education",
		"certification",
		"experience_professionnelle",
		"type_contrat",
		"media",
		"referent",
	];
}

function create_controllers(){

    foreach (models() as $table) {
       	$controller = Str::studly($table);

        Artisan::call('make:controller', [
            '--resource' => true,
            'name' => $controller."Controller"
        ]);

        Artisan::call('make:request', [
            'name' => $controller."CreateRequest"
        ]);

        Artisan::call('make:request', [
           'name' => $controller."UpdateRequest"
        ]);
    }  
}


function create_migrations(){

    foreach (models() as $table) {
       	//$models = Str::studly($table);

        Artisan::call('make:migration', [
            '--create' => $table,
           	'name' => "create_".$table."_table"
        ]);

        sleep(2);
    }  
}

function dateFormat($date, $type = 'table'){
	if (empty($date)) {
		return "";
	}
 	switch ($type) {
 		case 'table':
 			return Carbon::parse($date)->locale('fr_FR')->isoFormat('LL');
 			break;
 		case 'mysql':
 			return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
 			break;
 		case 'form':
 			return Carbon::parse($date)->format('d/m/Y');
 			break;
 		case 'isoFormat':
 			if (empty($date)) {
 				return trans("Jamais");
 			}
 			return Carbon::parse($date)->locale('fr_FR')->isoFormat('LLLL');
 			break;
 		case 'human':
 			return Carbon::parse($date)->diffForHumans();
 			break;
 		default:
 			return "";
 			break;
 	}
}


function generate_otp($n = 6) {
    $generator = "1357902468";
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
    // Return result 
    return $result; 
}

?>