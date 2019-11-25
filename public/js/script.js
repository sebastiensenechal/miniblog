tinyMCE.init({
  // type de mode
  mode : "textareas",
  // id ou class, des textareas
  elements : "content, comment",
  menubar: false,
  // HTML editor plugin
  plugins: [
    "lists link image",
    "visualblocks code",
    "paste imagetools wordcount"
  ],
  toolbar: "styleselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image",
  // chemin vers le fichier css
  content_css : "public/js/tinymce/skins/content/default/content.min.css",
  // couleur disponible dans la palette de couleur
  theme_advanced_text_colors : "#444, #EEA852",
  // balise html disponible
  theme_advanced_blockformats : "h3,h4,h5,h6",
  mobile: {
    theme: 'mobile',
    plugins: [ 'lists', 'link', 'paste' ]
  }
});
