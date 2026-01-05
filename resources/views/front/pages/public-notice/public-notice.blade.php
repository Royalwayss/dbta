@extends('front.layout.layout')
@section('content')
<main>
   <section class="list_committes_wrap_sec">
      <div class="heading-one heading_one_dtba"data-aos="fade-up">
         <h1 class="text-center img-text">Public Notice</h1>
         <div class="underline mx-auto mt-2"></div>
      </div>
   </section>
   <section>
      <div class="container my-5"data-aos="fade-up">
         <div class="table-responsive">
            <table class="table custom-table">
               <thead>
                  <tr>
                     <th style="width:15%">Date</th>
                     <th style="width:65%">Message</th>
                     <th style="width:20%"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($publicnotices as $publicnotice)
                  <tr>
                     <td>{{ date("d-m-Y", strtotime($publicnotice['date'])) }}</td>
                     <td><?php echo wordwrap($publicnotice['message'],75,"<br>\n"); ?></td>
                     <td>
                        <a href="{{ asset('front/images/public-notice/'.$publicnotice['file']) }}" class="read-link" target="_blank">View Details →</a>
                     </td>
                     @endforeach
               </tbody>
            </table>
         </div>
         
      </div>
   </section>
</main>
@endsection