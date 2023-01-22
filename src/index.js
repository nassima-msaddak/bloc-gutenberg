import { registerBlockType } from '@wordpress/blocks';
 
registerBlockType( 'bloc-gutenberg/test-block', {
    title: 'Bloc Gutenberg (Nassima)',
    icon: 'smiley',  // plus-alt
    category: 'theme',
    edit: () =><div><h1>Créer votre post</h1>
    <form
        method="post"
        action="">
        <p>
      <label>
        Titre:
        </label>
        <br />  
        <input
        id="titre"
          name="titre"
          type="text"
          required="true"
           placeholder ="Saisir le titre" 
            />
           
           </p>
           <span     id="err_titre_exist"></span>
      <p>
      <label>
        Message:
        </label>
        <br /> 
        <textarea
         id="message" 
          name="message" 
          required="true" 
          placeholder ="Saisir votre message"
          cols="45"
           rows="8"
            maxlength="65525" 
              />
            
      </p> 
      <input
          name="envoyer"
          type="submit" 
          value="Envoyer"
          class="wp-block-button__link wp-element-button"  />
    </form> 
    </div>  ,
    save: () =>  <div> <h1>Créer votre post</h1>
    <form
        method="post"
        action="" 
        >
        <p>
      <label>
        Titre:
        </label>
        <input
        id="titre"
          name="titre"
          type="text"
          required="true"
           placeholder ="Saisir le titre" 
            style="display: block;box-sizing: border-box;width: 100%;    border: 1px solid #949494;font-size: 1em;font-family: inherit;padding: calc(0.667em + 2px);" />
           </p>
           <span style="color:red;font-weight:bold;" id="err_titre_exist"></span>
      <p>
      <label>
        Message:
        </label>
        <textarea
           id="message" 
        name="message" 
          required="true" 
          placeholder ="Saisir votre message"
          cols="45"
           rows="8"
            maxlength="65525"
            style="display: block;box-sizing: border-box;width: 100%;    border: 1px solid #949494;font-size: 1em;font-family: inherit; padding: calc(0.667em + 2px);"
          />
      </p>
     
      <input
          name="envoyer"
          type="submit" 
          value="Envoyer"
          class="wp-block-button__link wp-element-button"  />
    </form> 
    </div>  ,
} );
 

   


