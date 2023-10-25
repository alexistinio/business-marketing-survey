<x-app-layout>
    <div class="container flex flex-wrap pt-4 pb-10 m-auto mt-2 md:mt-15 lg:px-12 xl:px-6" >
        <div class="text-sm breadcrumbs px-3">
            <ul>
              <li><a href="/">Home</a></li> 
              <li>Post</li> 
              <li>Answers</li>
            </ul>
          </div>
          
         
    <div class="w-full block xl:flex sm:mt-5 md:mt-2 lg:mt-2" >
        <div class="w-full mx-auto">
        @livewire('post.view-answer', ['id' => $post_id])
        </div>

    <input type="text" id="id_val" value="{{ $post_id }}" hidden>
        <div class="flex-col px-2" style="min-width: 50%">
          <div class="flex justify-content-between mt-4 xl:mt-0" style="border: 1px solid none">
        <div class="mb-2 mx-1 w-full" style="height: 65px">
       
          <form action="" id="link" method="get" style="height: 64px">
        
            <select id="graphs" name="graphs" class="shadow-2xl w-full px-5 h-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 bg-stone-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
       
              <option value="bar" {{ 'post/answers/'.$post_id == request()->path() ? 'selected' : '' }}{{ 'post/getLineGraph/'.$post_id.'/bar' == request()->path() ? 'selected' : ''}}>Bar Graph</option>
              <option value="line" {{ 'post/getGraph/'.$post_id.'/line' == request()->path() ? 'selected' : ''}}>Line Graph</option>
              <option value="doughnut" {{ 'post/getGraph/'.$post_id.'/doughnut' == request()->path() ? 'selected' : ''}}>Doughnut Graph</option>
              <option value="pie" {{ 'post/getGraph/'.$post_id.'/pie' == request()->path() ? 'selected' : ''}}>Pie Graph</option>
              <option value="radar" {{ 'post/getGraph/'.$post_id.'/radar' == request()->path() ? 'selected' : ''}}>Radar Graph</option>

            </select> 
           
        

       </div>
  
          </form>
          </div>
          
    <div class="card card-compact bg-base-100 shadow-xl p-0">
            <div class="card-body">
              <div class="py-5">
                <div class="barGraph">
                @isset($surveyChart)
                <h1>{!! $surveyChart->container() !!}</h1>
             @endisset
            
            {{-- Chartscript --}}
              @isset($surveyChart)
                {!! $surveyChart->script() !!}
              @endisset

              @isset($surveyChart1)
               {!! $surveyChart1->container() !!}
             @endisset
            
            {{-- Chartscript --}}
              @isset($surveyChart1)
                {!! $surveyChart1->script() !!}
              @endisset
                </div>
              </div>
            </div>
       </div>

    </div>
  </div>
  @push('js')
<script>
$(document).ready(function () {

    var id = $('#id_val').val()
    console.log(id)
    $('#graphs').change(function (e) { 
      e.preventDefault();
      
          var ref = $("#graphs").val()
          
          $('#link').attr('action', '/post/getGraph/'+id+'/'+ref);
          console.log(ref)

        $('#link').submit();

    });
  });
</script>
@endpush
</x-app-layout>

