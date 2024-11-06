@extends('user.layouts.master')
@section('content')
<div class="col-12 bg-light">
        <!-- Comment Start -->
        <div class="container-lg py-5 wow fadeInUp bg-dark-subtle" data-wow-delay="0.4s">
            {{-- <a href="{{ route('user#home') }}">
                <i class="fa-sharp fa-regular fa-circle-left text-dark fs-3 ms-4"></i>
            </a> --}}
            {{-- row is two side front->col-4 back->col-8 --}}
            <div class="row col-12">

                <div class="col-4">

                    <div class="p-3">
                        @if (session('insertSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{-- <strong>Posts</strong> ဖန်တီးခြင်းအောင်မြင်ပါသည် --}}
                                <strong>{{ session('insertSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('deleteSuccess'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{-- <strong>Posts</strong> ဖန်တီးခြင်းအောင်မြင်ပါသည် --}}
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('updateSuccess'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>{{ session('updateSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('user#post') }}" method="post">
                            @csrf

                            <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                            <input type="hidden" name="userAddress" value="{{Auth::user()->address}}">

                            <div class="text-group mb-3">
                                <label for="" class="pb-2">Post Your Comments</label>
                                <textarea name="postDescription" class="form-control @error('postDescription') is-invalid  @enderror" cols="30"
                                style="border-top-left-radius: 25px;border-bottom-right-radius: 25px;"
                                    rows="8" placeholder="Enter Post Description"></textarea>
                                @error('postDescription')
                                    <small class="text-danger"><b>မှတ်ချက်ပေးရန်စာရိုက်ရပါမည်...</b></small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="submit" name="" value="Post"
                                    class="btn btn-danger col-4 offset-8 text-dark" style="border-radius: 10px">
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col-8">
                    <div class="mt-3">
                        {{ $comments->links() }}
                    </div>
                    <div class="data-container">

                        @foreach ($comments as $comment)

                        <div class="post shadow-lg p-3">

                            @if (Auth::user()->id == $comment->user_id)
                               <h5 class="text-dark">Your Comment</h5>
                            @else
                                <h5 class="text-dark">{{ $comment->user_name}}</h5>
                            @endif

                            <span class="text-danger">{{$comment->created_at->format('j-M-Y -- g:i a')}}</span> |

                            <span class="text-danger fw-bold">{{$comment->address}}</span>

                            <p class="text-muted">{{ Str::words($comment->description,20,'...') }}</p>

                            <div class="text-end">
                                <a href="{{route('comment#view',$comment->id)}}">
                                    <button class="btn btn-sm mb-2" style="background-color: blue;color:rgb(215, 222, 255);border-radius:10px">
                                        <i class="fa-solid fa-file-lines me-1"></i>အပြည့်အစုံဖတ်ရန်...
                                    </button>
                                </a>

                                ‌@if (Auth::user()->id == $comment->user_id)
                                <a href="{{route('comment#delete',$comment->id)}}">
                                    <button type = "submit" class="btn btn-sm btn-danger mb-2" style="border-radius:10px">
                                        <i class="fa-solid fa-trash me-1"></i>ဖျက်ရန်...
                                    </button>
                                </a>
                                <a href="{{route('comment#edit',$comment->id)}}">
                                    <button type = "submit" class="btn btn-sm btn-danger mb-2" style="border-radius:10px">
                                        Editလုပ်ရန်...
                                    </button>
                                </a>
                                @else

                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
            <!-- Comment End -->
</div>
@endsection
