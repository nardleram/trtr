<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

<script>
tinymce.init({
  selector: 'textarea#trtr-article',
  promotion: false,
  branding:false,
  skin: 'oxide',
  content_style:
    "@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap&family=Sora:wght@100..800&display=swap&display=swap'); body { font-family: 'Cormorant Garamond', serif; color: rgb(72, 100, 125); font-weight: 300; font-size: 1rem; } h1,h2,h3,h4,h5,h6 { font-family: 'Cormorant Garamond', serif; }",
  font_family_formats: 'Cormorant Garamond=cormorant garamond',
  font_formats: 'Cormorant Garamond=cormorant garamond',
  color_map: [
    'rgb(1 41 56)', 'text base',
    'rgb(35 129 193)', 'dark blue',
    'rgb(59 159 222)', 'light blue',
    'rgb(190 18 60)', 'dark rose',
    'rgb(225 29 72)', 'medium rose',
    'rgb(253 164 175)', 'light rose',
  ],
  plugins: 'image lists emoticons link',
  toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | link emoticons image',
  images_upload_url: '/articles/images/store',
  image_title: true,
  automatic_uploads: true,
  image_uploadtab: false,
  file_picker_types: 'image',
  images_upload_credentials: true,
  file_picker_callback: function (cb, value, meta) {
    const input = document.createElement('input')
    input.setAttribute('type', 'file')
    input.setAttribute('accept', 'image/*')
    input.addEventListener('change', (e) => {
      console.log('file_picker_callback')
      const file = e.target.files[0]

      const reader = new FileReader()
      reader.addEventListener('load', () => {
        const id = 'blobid' + (new Date()).getTime()
        const blobCache =  tinymce.activeEditor.editorUpload.blobCache
        const base64 = reader.result.split(',')[1]
        const blobInfo = blobCache.create(id, file, base64)
        blobCache.add(blobInfo)

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      });
      reader.readAsDataURL(file);
    });

    input.click();
  }
});


tinymce.init({
  selector: 'textarea.trtr-forum-thread',
  promotion: false,
  branding:false,
  skin: 'oxide',
  height: '250',
  content_style:
    "@import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap'); body { font-family: 'Cormorant Garamond', serif; color: rgb(72, 100, 125); font-weight: 300; font-size: 1.1rem; } h1,h2,h3,h4,h5,h6 { font-family: 'Cormorant Garamond', serif; }",
  font_family_formats: 'Cormorant Garamond=cormorant garamond',
  font_formats: 'Cormorant Garamond=cormorant garamond',
  color_map: [
    'rgb(72 100 125)', 'text base',
    'rgb(35 129 193)', 'dark blue',
    'rgb(59 159 222)', 'light blue',
    'rgb(190 18 60)', 'dark rose',
    'rgb(225 29 72)', 'medium rose',
    'rgb(253 164 175)', 'light rose',
  ],
  plugins: 'lists emoticons',
  toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | emoticons',

});
</script>