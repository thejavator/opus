<div class="row text-center">
    <div class="center-block user-profile">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="user-profile-pic">
                @if(empty($user->profile_image))
                    <img src="/images/default.png" class="img-rounded" width="90" height="90" alt="Image" style="border-radius: 50%; border: 1px solid rgba(0,0,0,0.1);">
                @else
                    <img src="/images/profile-pics/{{ $user->profile_image }}" class="img-rounded" width="90" height="90" alt="Image" style="border-radius: 50%; border: 1px solid rgba(0,0,0,0.1);">
                @endif
            </div>
            @if(!empty($user->full_name))
                <p style="margin-top: 8px; margin-bottom: 0px; font-size: 17px; text-transform: capitalize; font-weight: 600;" title="{{ $user->full_name }}">{{ $user->full_name }}</p>
            @endif    
            <p style="margin-bottom: 2px;"><span class="dot-divider" title="{{ $user->name }}">{{ '@' . $user->name }}</span> <span style="cursor: default;" data-toggle="tooltip" data-placement="bottom" title="{{ $user->created_at->toFormattedDateString() . ' at ' . $user->created_at->format('h:i A')}}"><i class="fa fa-clock-o"></i> Member since {{  $user->created_at->toFormattedDateString() }}</span></p>
            <p style="margin-bottom: 0;">
                <span class="@if(!empty($user->location)) dot-divider @endif" title="email">
                    <i class="fa fa-envelope"></i> <a href="mailto:{{ $user->email  }}">{{ $user->email  }}</a>
                </span> 
                @if(!empty($user->location))
                    <span title="location"><i class="fa fa-map-marker"></i> {{ $user->location }}</span>
                @endif
            </p>
            @if(!empty($user->bio))
                <p style="margin-bottom: 0; margin-top: 5px;" title="bio">{{ $user->bio }}</p>
            @endif
            @if($user->id != Auth::user()->id)
                <div class="profile-btn" style="position: absolute; top: 0px; right: 0px;">
                    <ul class="list-unstyled list-inline">
                        <li style="padding: 0;">
                            @if(ViewHelper::isFollowing($user->id)) 
                                <a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Unfollow" onclick="event.preventDefault(); document.getElementById('unfollow-form').submit();"><i class="fa fa-minus"></i></a>
                                <form id="unfollow-form" action="{{ route('users.unfollow') }}" method="POST" class="hide">
                                    {!! method_field('post') !!}
                                    {{ csrf_field() }}
                                    <input type="text" name="user_id" class="hide" value="{{ $user->id }}">
                                </form>
                            @else 
                                <a href="#" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Follow" onclick="event.preventDefault(); document.getElementById('follow-form').submit();"><i class="fa fa-plus"></i></a>
                                <form id="follow-form" action="{{ route('users.follow') }}" method="POST" class="hide">
                                    {!! method_field('post') !!}
                                    {{ csrf_field() }}
                                    <input type="text" name="user_id" class="hide" value="{{ $user->id }}">
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>    
            @endif
            @if($user->organizations->count() > 0)
                <ul class="list-unstyled list-inline" style="width: 260px; margin: auto; line-height: 3.5em;">
                    @foreach($user->organizations as $organization)
                        <li class="list-group-item" style="padding: 0px; border: none;" data-toggle="tooltip" data-placement="bottom" title="{{ $organization->name }}">
                            <a href="{{ route('organizations.show', $organization->slug)  }}">
                                <img src="/images/no_organization_avatar.png" width="40" height="40" alt="Image" style="border: 1px solid rgba(0,0,0,0.1); border-radius: 3px;">
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>