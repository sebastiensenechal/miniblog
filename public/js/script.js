tinyMCE.init({
  // type de mode
  mode : "textareas",
  // id ou class, des textareas
  elements : "content, comment",
  // HTML editor plugin
  plugins: [
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table paste imagetools wordcount"
  ],
  // toolbar: "code",
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  image_title: true,
  // chemin vers le fichier css
  content_css : "public/js/tinymce/skins/content/default/content.min.css",
  // couleur disponible dans la palette de couleur
  theme_advanced_text_colors : "#444, #EEA852",
  // balise html disponible
  theme_advanced_blockformats : "h3,h4,h5,h6",
});
