<?php

/**
 * Plugin Name: Bloc Gutenberg
 */
 /*
 Description: Plugin pour Stratis World Wide (Nassima)
 Version: 1.0.0
*/



 require_once(dirname(dirname(dirname(dirname(__FILE__))))."\wp-includes\pluggable.php" );  
 require_once(dirname(dirname(dirname(dirname(__FILE__))))."\wp-admin\includes\post.php" ); 



function create_bloc_init() {
    $asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');
    wp_register_script(
        'mon-plugin-bloc-gutenberg',
        plugins_url( 'build/index.js', __FILE__ ),
        $asset_file['dependencies'],
        $asset_file['version']
    );
    register_block_type( 'bloc-gutenberg/test-block', [
        'editor_script' => 'mon-plugin-bloc-gutenberg',
    ] );
}
add_action( 'init', 'create_bloc_init' );   // ajouter bloc gutenberg



function send_email_to_admins( $titre , $message )
{
    $subject = 'Un nouveau post d’article « '. strip_tags($_POST["titre"]) .'! » non publié'; 
	$message = '<div> <label>Titre:</label><p>'.strip_tags($_POST["titre"]). '</p><br><label>Message:</label><p>'. strip_tags($_POST["message"] )."</p></div>"; 

    $admins = get_users( array( 'role__in' => array( 'administrator' ) ) );
    foreach ( $admins as $admin ) { 
        wp_mail(  $admin->user_email, $subject, $message );
    }

}


if( isset($_POST["titre"])     &&   isset($_POST["message"]) ){ 
 
   // Vérifions si l'article existe déja 
    $fount_post = post_exists( strip_tags($_POST["titre"]) ,'','','');
    if($fount_post){

        //echo '<script>alert("Oops! Il existe déja un article avec ce titre!")</script>';

        echo '<script  type="module" >  
        document.getElementById("err_titre_exist").textContent = "Oops! Il existe déja un article avec ce titre!";   // message d erreur (titre existe)
   
     
         document.addEventListener("DOMContentLoaded", function(){
           document.getElementById("titre").value = "'.$_POST["titre"].'";
             document.getElementById("message").textContent = "'.$_POST["message"].'"; 
             document.getElementById("titre").focus().val(document.getElementById("titre").val());   // pointer cusor dans le champ title pour le modifier
         });
          </script>';
         
    } else {

        echo '<script  type="module" > 
            document.getElementById("err_titre_exist").textContent = "";
        </script>';


        // Enregistrer l'article
        $wordpress_post = array(
            'post_content' => '<p>' . strip_tags($_POST["message"]) . '</p>',
            'post_type' => 'post',
            'post_title' => strip_tags($_POST["titre"]),
            'post_status' => 'draft',  // non publié 
            //'post_author' => 1        // sans auteur
        );
        wp_insert_post($wordpress_post);


        // envoie d'emails aux administrateurs (Puisque nous pourrons avoir plusieurs)
        send_email_to_admins($_POST["titre"], $_POST["message"]);
    }


} 