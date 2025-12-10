<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <title><?php echo e(config('constants.project_name')); ?> Admin Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/css/adminlte.min.css')); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/summernote/summernote-bs4.min.css')); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2/css/select2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/css/jquery.ui.autocomplete.css')); ?>">
  <style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice
    {
      color:#000;
     
    }

    .select2-container--default .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--multiple
    {
      background-color:transparent;
      border-color:#6c757d;
    }
	#ui-tooltip-0{ display:none !important; }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?php echo e(asset('admin/images/AdminLTELogo.png')); ?>" alt="AdminLTELogo" height="60" width="60">
  </div>

  <?php echo $__env->make('admin.layout.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php echo $__env->make('admin.layout.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <?php echo $__env->yieldContent('content'); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <?php echo $__env->make('admin.layout.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap -->
<script src="<?php echo e(asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('admin/js/adminlte.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('admin/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo e(asset('admin/plugins/jquery-mousewheel/jquery.mousewheel.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/raphael/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/jquery-mapael/jquery.mapael.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/jquery-mapael/maps/usa_states.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('admin/plugins/chart.js/Chart.min.js')); ?>"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('admin/js/demo.js')); ?>"></script>
<!-- Page specific script -->
<script>
  $(function () {
    
    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('admin/js/pages/dashboard2.js')); ?>"></script>
<!-- Custom JS -->
<script src="<?php echo e(asset('admin/js/custom.js')); ?>"></script>
<!-- Autocomplete UI -->
<script src="<?php echo e(asset('admin/js/jquery-ui.min.js')); ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo e(asset('admin/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- Select2 -->
<script src="<?php echo e(asset('admin/plugins/select2/js/select2.full.min.js')); ?>"></script>
<script>
  $('.select2').select2();
</script>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Jquery Multiple Image Upload with Preview and Delete -->
<script>

  function product_attr_status_update(_this){
        var id = $(_this).attr('data-id');
         var attr = $(_this).attr('data-attr');
         if (_this.checked) {
             var status = 'Yes';
         }else{
             var status = 'No';
         }
         $.ajax({
                type:"POST",
                cache:false,
                url:"<?php echo e(asset('admin/attr-status-update')); ?>",
                data:{id:id,attr:attr,status:status,"_token" : "<?php echo e(csrf_token()); ?>",},    
                success: function (res) {
                }
      });
    }
  
  $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
</script>
<!-- Editor -->
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/ckeditor.js"></script>
      <!--
          Uncomment to load the Spanish translation
          <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/super-build/translations/es.js"></script>
      -->
      <script>
          // This sample still does not showcase all CKEditor 5 features (!)
          // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
          CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
              // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
              toolbar: {
                  items: [
                      'exportPDF','exportWord', '|',
                      'findAndReplace', 'selectAll', '|',
                      'heading', '|',
                      'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                      'bulletedList', 'numberedList', 'todoList', '|',
                      'outdent', 'indent', '|',
                      'undo', 'redo',
                      '-',
                      'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                      'alignment', '|',
                      'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                      'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                      'textPartLanguage', '|',
                      'sourceEditing'
                  ],
                  shouldNotGroupWhenFull: true
              },
              // Changing the language of the interface requires loading the language file using the <script> tag.
              // language: 'es',
              list: {
                  properties: {
                      styles: true,
                      startIndex: true,
                      reversed: true
                  }
              },
              // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
              heading: {
                  options: [
                      { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                      { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                      { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                      { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                      { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                      { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                      { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                  ]
              },
              // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
              placeholder: 'Welcome to CKEditor 5!',
              // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
              fontFamily: {
                  options: [
                      'default',
                      'Arial, Helvetica, sans-serif',
                      'Courier New, Courier, monospace',
                      'Georgia, serif',
                      'Lucida Sans Unicode, Lucida Grande, sans-serif',
                      'Tahoma, Geneva, sans-serif',
                      'Times New Roman, Times, serif',
                      'Trebuchet MS, Helvetica, sans-serif',
                      'Verdana, Geneva, sans-serif'
                  ],
                  supportAllValues: true
              },
              // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
              fontSize: {
                  options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                  supportAllValues: true
              },
              // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
              // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
              htmlSupport: {
                  allow: [
                      {
                          name: /.*/,
                          attributes: true,
                          classes: true,
                          styles: true
                      }
                  ]
              },
              // Be careful with enabling previews
              // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
              htmlEmbed: {
                  showPreviews: true
              },
              // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
              link: {
                  decorators: {
                      addTargetToExternalLinks: true,
                      defaultProtocol: 'https://',
                      toggleDownloadable: {
                          mode: 'manual',
                          label: 'Downloadable',
                          attributes: {
                              download: 'file'
                          }
                      }
                  }
              },
              // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
              mention: {
                  feeds: [
                      {
                          marker: '@',
                          feed: [
                              '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                              '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                              '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                              '@sugar', '@sweet', '@topping', '@wafer'
                          ],
                          minimumCharacters: 1
                      }
                  ]
              },
              // The "super-build" contains more premium features that require additional configuration, disable them below.
              // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
              removePlugins: [
                  // These two are commercial, but you can try them out without registering to a trial.
                  // 'ExportPdf',
                  // 'ExportWord',
                  'CKBox',
                  'CKFinder',
                  'EasyImage',
                  // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                  // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                  // Storing images as Base64 is usually a very bad idea.
                  // Replace it on production website with other solutions:
                  // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                  // 'Base64UploadAdapter',
                  'RealTimeCollaborativeComments',
                  'RealTimeCollaborativeTrackChanges',
                  'RealTimeCollaborativeRevisionHistory',
                  'PresenceList',
                  'Comments',
                  'TrackChanges',
                  'TrackChangesData',
                  'RevisionHistory',
                  'Pagination',
                  'WProofreader',
                  // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                  // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                  'MathType',
                  // The following features are part of the Productivity Pack and require additional license.
                  'SlashCommand',
                  'Template',
                  'DocumentOutline',
                  'FormatPainter',
                  'TableOfContents'
              ]
          });
      </script>





</body>
</html>
<?php /**PATH /home/rtpltechin/dbta.rtpltech.in/resources/views/admin/layout/layout.blade.php ENDPATH**/ ?>