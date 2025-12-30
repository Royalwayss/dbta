@extends('front.layout.layout')
@section('content')




    <style>
        /* Container Styles */
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }

        /* Search Box */
        .search-box {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #cfd8dc;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 30px;
            outline: none;
        }

        /* Search Box Focus Effect */
        .search-box:focus {
            border-color: #00608e;
            box-shadow: 0 0 5px rgba(31, 79, 216, 0.5);
        }

        /* Grid Layout */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        @media screen and (max-width: 768px) {
            .grid-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (max-width: 480px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
        }

        /* Member Card */
        .member-card {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .member-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .member-card .name {
            font-size: 18px;
            font-weight: 600;
            color: #00608e;
        }

        .member-card .role {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .member-card .details {
            font-size: 13px;
            line-height: 1.6;
        }

        .member-card .details strong {
            font-weight: 700;
        }

        .member-card div {
            text-align: left;
        }
    </style>







<main>
	
	<section class="list_committes_wrap_sec">
		<div class="heading-one heading_one_dtba"data-aos="fade-up">
			<h1 class="text-center img-text">Member's Directory</h1>
			<div class="underline mx-auto mt-2"></div>
		</div>
	</section>
	
	
	<section>
    <div class="container">
        <!-- Search Box -->
        <input type="text" id="search-box" placeholder="Search by name or prefix or serial number..." class="search-box" />

        <!-- Grid Container -->
        <div class="grid-container" id="members_directory">
			@include('front.pages.members_directory.members_directory_list')
        </div>
    </div>
</section>


</main>
<script type="text/javascript" src="{{ asset('front/assets/js/ajax_jquery.min.js') }}"></script>
<script>
$(document).ready(function() {
  $("#search-box").keyup(function() {
    var keyword = $(this).val(); 
	
	
	$.ajax({
				url: "{{ route('members_directory') }}",
				type:'POST',
				data: {
					 _token: '{{ csrf_token() }}', 
					 keyword: keyword     
                },
				success: function(data) {
					$('.PleaseWaitDiv').hide();
					if(data.status){
						$("#members_directory").html(data.html);
					}
				}
			});
	
	
    
	
	
	
	
	
	
	
	
	
  });
});
</script>
@endsection