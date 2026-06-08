@if(!empty($members_directory))
	@foreach($members_directory as $member)
<div class="member-card">

    <div class="name">
       <span class="designation_prefix"> {{ $member['designation_prefix'] }}</span> <span class="member_name">{{ $member['member_name'] }}<span>
    </div>

    <div class="member-content">
        @if(!empty($member['profile']))
        <div class="profile">
            <img class="card-img-top" style="cursor:pointer;"  onclick="showPopup(this.src)"  src="{{ asset('uploads/members-directory/profile/'.$member['profile']) }}"  alt="{{ $member['member_name'] }}"> 
        </div>
        @endif
        <div class="details">
            <div><strong>Serial No:</strong> {{ $member['serial_no'] }}</div>

            @if(!empty($member['contact_no']))
                <div><strong>Contact:</strong> {{ $member['contact_no'] }}</div>
            @endif

            @if(!empty($member['email']))
                <div><strong>Email:</strong> {{ $member['email'] }}</div>
            @endif

            @if(!empty($member['address']))
                <div><strong>Address:</strong> {{ $member['address'] }}</div>
            @endif
        </div>

    </div>

</div>
@endforeach
@else
	<p><strong>Members Directory not found</strong></p>
@endif
           