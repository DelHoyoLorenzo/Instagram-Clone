import LikeButton from '@/Components/LikeButton'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import SideBar from '@/shared/SideBar';
import React from 'react'

function Index({ posts, user, profile, auth }) {

  return (
    <AuthenticatedLayout user={auth.user} /* header={<SideBar />} */>
        <div className="container bg-black text-white">
            <div className="row">
                <div className="col-9">
                {posts.map((post, index) => (
                    <div key={post.id}>
                        <div className="col-6 offset-2 py-3 d-flex gap-3 text-white align-items-center">
                            <div className="w-25">
                                <a className="text-decoration-none" href={`/profile/${post.user.id}`}>
                                    <img className="w-100 p-0 m-0 rounded-circle" /* src="{ post.user.profile.profileImage }" */ alt="user-profile-image" />
                                </a>
                            </div>
                            <div className="pl-1 w-full">
                                <p className="fw-bold m-0">
                                    <a className="text-decoration-none" href={`/profile/${post.user.id}`}>{ post.user.username }</a>
                                </p>
                            </div>
                        </div>
                        
                        <div className="col-7 offset-2">
                            <a href={`/p/${post.id}`}>
                                <img className="w-100 rounded" src={`/storage/${post.image}`} alt="post-image" />
                            </a>
                        </div>
                        <div className="col-6 offset-2 py-2">
                            <div className="d-flex gap-1 my-2">
                                {/* <LikeButton liked={ post.likes } post_id={post.id} user_id={auth.user.id} key={post.id} /> */}
                                {/* <div className="likeButton" id="LikeButton" className="like-button" liked={{ $post->likes }} post_id={{ $post->id }} user_id={{ auth()->user()->id }} key={{ $post->id }} ></div> */}
                                <a href={`/p/${post.id}`}>
                                    <svg width="25" viewBox="0 0 32.00 32.00" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000" transform="matrix(-1, 0, 0, 1, 0, 0)rotate(0)" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.384"></g><g id="SVGRepo_iconCarrier"> <title>comment-1</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.00032" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-100.000000, -255.000000)" fill="#ffffff"> <path d="M116,281 C114.832,281 113.704,280.864 112.62,280.633 L107.912,283.463 L107.975,278.824 C104.366,276.654 102,273.066 102,269 C102,262.373 108.268,257 116,257 C123.732,257 130,262.373 130,269 C130,275.628 123.732,281 116,281 L116,281 Z M116,255 C107.164,255 100,261.269 100,269 C100,273.419 102.345,277.354 106,279.919 L106,287 L113.009,282.747 C113.979,282.907 114.977,283 116,283 C124.836,283 132,276.732 132,269 C132,261.269 124.836,255 116,255 L116,255 Z" id="comment-1" sketch:type="MSShapeGroup"></path></g></g></g></svg>
                                </a>
                            </div>
                
                
                            <div className="d-flex align-items-baseline gap-2">
                                <div>
                                    <a className="text-decoration-none fw-bold" href={`/profile/${post.user.id}`}>
                                        <span>{ post.user.username }</span>
                                    </a>
                                </div>
                                <p className="p-0 m-0 font-weight-bold text-white">{ post.caption }</p>
                            </div>
                            <a className="text-decoration-none m-0 p-0" href={`/p/${post.id}`}>
                                {/* <p className="p-0 my-2 text-comment" >View all <span>{{ $post->comments->count() || '' }}</span> comments...</p> */}
                            </a>
                        </div>
                        <hr className="col-7 offset-2 my-0" />
                    
                

                    </div>
                
                
                ))}
                </div>
                {/* {{-- side bar user info --}} */}
                <div className="col-3 py-4 d-flex flex-column">
                    <div className="col-6 d-flex align-items-center w-100">
                            <div className="w-25">
                                <a className="text-decoration-none" href="/profile/{{auth()->user()->id}}">
                                    <img className="w-100 rounded-circle" src="" alt="user-profile-image" />
                                </a>
                            </div>
                            <div className="d-flex flex-column align-items-baseline ml-[10px]" >
                                <a className="text-decoration-none" href="/profile/{{auth()->user()->id}}">
                                    <p className="fw-bold m-0">{ auth.user.username }</p>
                                    <p>{ auth.user.profile.description }</p>
                                </a>
                            </div>
                    </div>
                    <div>
                        <p>Suggested for you</p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
  )
}

export default Index