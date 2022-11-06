<?php

class Settings extends App {



    public static function update($name, $value) { //update config value
    	global $database;
    	$database->update("core_config", ["value" => $value], ["name" => $name]);
    }


    public static function editNotification($data) { //update notification template
    	global $database;
    	$database->update("core_notifications", ["subject" => $data['subject'], "message" => $data['message']], ["id" => $data['id']]);
    	return 40;
    }


    public static function addLanguage($data) {
    	global $database;
    	$lastid = $database->insert("core_languages", [ "code" => $data['code'], "name" => $data['name'] ]);
    	if ($lastid == "0") { return "11"; } else { logSystem("Language Added - ID: " . $lastid); return "10"; }
    }


    public static function deleteLanguage($id) {
    	global $database;
        $database->delete("core_languages", [ "id" => $id ]);
    	logSystem("Language Deleted - ID: " . $id);
    	return "30";
    }

	public static function updateOrCreate($name, $value) { //update setting value or create new if not existed
		global $database;
		$telegramOptions = $database->select("core_config", "*", ["name" => $name]);
		if(!empty($telegramOptions)) {
			$database->update("core_config", ["value" => $value], ["name" => $name]);
			return 40;
		}
		$database->insert("core_config", ["value" => $value, "name" => $name]);
		return 40;
	}




}


?>
