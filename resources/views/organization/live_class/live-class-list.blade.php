@extends('layouts.organization')

@section('breadcrumb')
<div class="page-banner-content text-center">
    <h3 class="page-banner-heading text-white pb-15"> {{__('My Courses')}} </h3>

    <!-- Breadcrumb Start-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item font-14"><a href="{{route('organization.dashboard')}}">{{__('Dashboard')}}</a></li>
            <li class="breadcrumb-item font-14"><a href="{{ route('organization.live-class.course-live-class.index') }}">{{ __('Live
                    Class Course List') }}</a></li>
            <li class="breadcrumb-item font-14 active" aria-current="page">{{ __('Live Class List') }}</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="instructor-profile-right-part" id="meet">
    <div class="instructor-quiz-list-page instructor-live-class-list-page">

        <div class="instructor-my-courses-title d-flex justify-content-between align-items-center">
            <h6>{{ @$course->title }}</h6>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs assignment-nav-tabs live-class-list-nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ @$navUpcomingActive }}" id="upcoming-tab" data-bs-toggle="tab"
                            data-bs-target="#upcoming" type="button" role="tab" aria-controls="upcoming"
                            aria-selected="true">{{ __('Upcoming') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ @$navPastActive }}" id="past-tab" data-bs-toggle="tab"
                            data-bs-target="#past" type="button" role="tab" aria-controls="past"
                            aria-selected="false">{{ __('Past') }}
                        </button>
                    </li>
                </ul>

                <div class="tab-content live-class-list" id="myTabContent">
                    <div class="tab-pane fade {{ @$tabUpcomingActive }}" id="upcoming" role="tabpanel"
                        aria-labelledby="upcoming-tab">
                        @if(count($upcoming_live_classes) > 0)
                        <div class="table-responsive table-responsive-xl">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Topic') }}</th>
                                        <th scope="col">{{ __('Date & Time') }}</th>
                                        <th scope="col">{{ __('Time Duration') }}</th>
                                        <th scope="col">{{ __('Meeting Host Name') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcoming_live_classes as $upcoming_live_class)
                                    <tr>
                                        <td>{{ Str::limit($upcoming_live_class->class_topic, 50) }}</td>
                                        <td>{{ $upcoming_live_class->date }}</td>
                                        <td>{{ $upcoming_live_class->duration }} minutes</td>
                                        <td>
                                            @if($upcoming_live_class->meeting_host_name == 'zoom')
                                            Zoom
                                            <button
                                                class="theme-btn theme-button1 green-theme-btn default-hover-btn viewMeetingLink"
                                                data-item="{{ $upcoming_live_class }}">
                                                {{ __('View') }}
                                            </button>
                                            @elseif($upcoming_live_class->meeting_host_name == 'bbb')
                                            BigBlueButton
                                            <button
                                                class="theme-btn theme-button1 green-theme-btn default-hover-btn viewBBBMeetingLink"
                                                data-item="{{ $upcoming_live_class }}"
                                                data-route="{{ route('consultation.join-bbb-meeting', $upcoming_live_class->id) }}">
                                                {{ __('View') }}
                                            </button>
                                            @elseif($upcoming_live_class->meeting_host_name == 'jitsi')
                                            Jitsi
                                            <button
                                                class="theme-btn theme-button1 green-theme-btn default-hover-btn viewJitsiMeetingLink"
                                                data-item="{{ $upcoming_live_class }}"
                                                data-route="{{ route('join-jitsi-meeting', $upcoming_live_class->uuid) }}">
                                                {{ __('View') }}
                                            </button>
                                            @elseif($upcoming_live_class->meeting_host_name == 'gmeet')
                                            Gmeet
                                            <button
                                                class="theme-btn theme-button1 green-theme-btn default-hover-btn viewGmeetMeetingLink"
                                                data-url="{{ $upcoming_live_class->join_url }}">
                                                {{ __('View') }}
                                            </button>
                                            @endif
                                        </td>

                                        <td><a href="javascript:void(0);"
                                                data-url="{{ route('organization.live-class.delete', $upcoming_live_class->uuid) }}"
                                                class="theme-btn default-delete-btn-red delete"><span class="iconify"
                                                    data-icon="gg:trash"></span>{{ __('Delete') }}</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <!-- If there is no data Show Empty Design Start -->
                        <div class="empty-data">
                            <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img"
                                class="img-fluid">
                            <h4 class="my-3">{{ __('Empty Live Class') }}</h4>
                        </div>
                        <!-- If there is no data Show Empty Design End -->
                        @endif
                        <!-- Pagination Start -->
                        @if(@$upcoming_live_classes->hasPages())
                        {{ @$upcoming_live_classes->links('frontend.paginate.paginate') }}
                        @endif
                        <!-- Pagination End -->
                    </div>
                    <div class="tab-pane fade {{ @$tabPastActive }}" id="past" role="tabpanel"
                        aria-labelledby="upcoming-tab">
                        @if(count($past_live_classes) > 0)
                        <div class="table-responsive table-responsive-xl">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('Topic') }}</th>
                                        <th scope="col">{{ __('Date & Time') }}</th>
                                        <th scope="col">{{ __('Time Duration') }}</th>
                                        <th scope="col">{{ __('Meeting Host Name') }}</th>
                                        <th scope="col">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($past_live_classes as $past_live_class)
                                    <tr>
                                        <td>{{ Str::limit($past_live_class->class_topic, 50) }}</td>
                                        <td>{{ $past_live_class->date }}</td>
                                        <td>{{ $past_live_class->duration }} minutes</td>
                                        <td>
                                            @if($past_live_class->meeting_host_name == 'zoom')
                                            Zoom
                                            <button
                                                class="theme-btn theme-button1 green-theme-btn default-hover-btn viewMeetingLink"
                                                data-item="{{ $past_live_class }}">
                                                {{ __('View') }}
                                            </button>
                                            @elseif($past_live_class->meeting_host_name == 'bbb')
                                            BigBlueButton
                                            <button
                                                class="theme-btn theme-button1 green-theme-btn default-hover-btn viewBBBMeetingLink"
                                                data-item="{{ $past_live_class }}"
                                                data-route="{{ route('consultation.join-bbb-meeting', $past_live_class->id) }}">
                                                {{ __('View') }}
                                            </button>
                                            @elseif($past_live_class->meeting_host_name == 'jitsi')
                                            Jitsi
                                            <button
                                                class="theme-btn theme-button1 green-theme-btn default-hover-btn viewJitsiMeetingLink"
                                                data-item="{{ $past_live_class }}"
                                                data-route="{{ route('join-jitsi-meeting', $past_live_class->uuid) }}">
                                                {{ __('View') }}
                                            </button>
                                            @elseif($past_live_class->meeting_host_name == 'gmeet')
                                            Gmeet
                                            <button
                                                class="theme-btn theme-button1 green-theme-btn default-hover-btn viewGmeetMeetingLink"
                                                data-url="{{ $past_live_class->join_url }}">
                                                {{ __('View') }}
                                            </button>
                                            @endif
                                        </td>

                                        <td><a href="javascript:void(0);"
                                                data-url="{{ route('organization.live-class.delete', $past_live_class->uuid) }}"
                                                class="theme-btn default-delete-btn-red delete">
                                                <span class="iconify" data-icon="gg:trash"></span>{{ __('Delete') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <!-- If there is no data Show Empty Design Start -->
                        <div class="empty-data">
                            <img src="{{ asset('frontend/assets/img/empty-data-img.png') }}" alt="img"
                                class="img-fluid">
                            <h4 class="my-3">{{ __('Empty Past Class') }}</h4>
                        </div>
                        <!-- If there is no data Show Empty Design End -->
                        @endif
                        <!-- Pagination Start -->
                        @if(@$past_live_classes->hasPages())
                        {{ @$past_live_classes->links('frontend.paginate.paginate') }}
                        @endif
                        <!-- Pagination End -->
                    </div>
                </div>

                <!-- Add Live Class Button Start -->
                <a href="{{ route('organization.live-class.course-live-class.index') }}"
                    class="theme-btn theme-button3 quiz-back-btn default-hover-btn">{{ __('Back') }}</a>
                <a href="{{ route('organization.live-class.create', $course->uuid) }}"
                    class="add-resources-btn theme-btn theme-button1 default-hover-btn">{{ __('Add Live Class') }}</a>
                <!-- Add Live Class Button End -->

            </div>
        </div>

    </div>
</div>
@endsection

@section('modal')
<!--View Meeting Modal Start-->
<div class="modal fade viewMeetingLinkModal" id="viewMeetingModal" tabindex="-1" aria-labelledby="viewMeetingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="viewMeetingModalLabel">{{ __('View Meeting') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-none bbbMeetingDiv">
                    <div class="row mb-30">
                        <div class="col-md-12">
                            <div class="join-url-wrap position-relative">
                                <label class="font-medium font-15 color-heading">{{ __('Meeting ID') }}</label>
                                <input type="text" name="meeting_id" class="form-control" disabled readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-30">
                        <div class="col-md-12">
                            <div class="join-url-wrap position-relative">
                                <label class="font-medium font-15 color-heading">{{ __('Moderator Password') }}</label>
                                <input type="text" name="moderator_pw" class="form-control" disabled readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-30">
                        <div class="col-md-12">
                            <div class="join-url-wrap position-relative">
                                <label class="font-medium font-15 color-heading">{{ __('Attendee Password') }}</label>
                                <input type="" name="attendee_pw" class="form-control" disabled readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-30 d-none zoomMeetingDiv">
                    <div class="col-md-12">
                        <div class="join-url-wrap position-relative">
                            <label class="font-medium font-15 color-heading">{{ __('Start URL') }}</label>
                            <textarea name="start_url" class="start_url join-url-text form-control" id="start_url"
                                disabled readonly rows="3">
                            </textarea>
                            <button class="copy-text-btn position-absolute copyZoomStartUrl"><span class="iconify"
                                    data-icon="akar-icons:copy"></span></button>
                        </div>
                    </div>
                </div>
                <div class="row mb-30 d-none jitsiMeetingDiv">
                    <div class="col-md-12">
                        <div class="join-url-wrap position-relative">
                            <label class="font-medium font-15 color-heading">{{ __('Jitsi Meeting ID/Room') }}</label>
                            <input type="text" name="jitsi_meeting_id" class="form-control jitsi_meeting_id" disabled
                                readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between align-items-center">
                <a href="" target="_blank" class="theme-btn theme-button1 default-hover-btn green-theme-btn joinNow">{{
                    __('Start Now') }}</a>
            </div>
        </div>
    </div>
</div>
<!--View Meeting Modal End-->
@endsection

@push('script')
<script src="{{ asset('frontend/assets/js/instructor/copy-zoom-url-and-show.js') }}"></script>
@endpush
