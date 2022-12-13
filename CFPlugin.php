<?php

  /** Plugin declaration
   * extends MantisPlugin
   */

class CFPlugin extends MantisPlugin  
 {

## Register
 function register()
    {
      $this->name = 'CFPlugin';
      $this->description = 'Show Cf Fields on bug_change_status_page';
      $this->page = '';

      $this->version = '0.0.1';
      $this->requires = array(
        "MantisCore" => "2.0.0",
      );

      $this->author = 'bluescreenterror';
      $this->url = 'https://github.com/Selonka/Mantis_Show_Custom_Name_Plugin';
    }
  
  function config()
  {
    return array();
  }

  # Hooks 
  function hooks()
  {
        return array(
          "EVENT_UPDATE_BUG_SHOW_CUSTOM_FIELD" => 'ShowCFFields'
        );
  }

  function ShowCFFields($p_event, $p_bug_data, $p_custom_field_Id)
  {
    $t_project_id = $p_bug_data->project_id;
    $t_parent_project_Id = project_hierarchy_get_parent($t_project_id);
    $t_bug_id = $p_bug_data -> id;
    
    if($t_project_id != "33" and $t_parent_project_Id != "33"){
      return false;
    }

    $t_def = custom_field_get_definition( $p_custom_field_Id );
    $t_name = $t_def['name'];

    if($t_name == "Release Note Text"){
      return true;
    }

    if($t_name == "Release Type"){
      return true;
    }

    return false;
  }


}




