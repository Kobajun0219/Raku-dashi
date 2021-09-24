<!-- resources/views/common/errors.blade.php -->
@if (count($com) > 0)
    <!-- Form Error List -->
    <div class="alert alert alert-warning" id="com">
        <div><strong>{{$com[0]}}完了しました！</strong></div> 
    </div>
    
    <script>
          setTimeout(() => {
            $('#com').fadeOut();
          }, 2000);
    </script>
@endif