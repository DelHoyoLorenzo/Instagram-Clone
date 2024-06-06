import React, { useState } from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import FollowButton from '@/Components/FollowButton'
import LikeButton from '@/Components/LikeButton';

function Post({ post, isFollowed, auth }) {
    console.log(post);

    const [comment, setComment] = useState({
        comment: '',
    })

    const handleChange = (e) => {
        console.log(e.target.value)
        setComment({
            ...comment,
            comment: e.target.value
        })
    }

    const handleComment = async () => {
        try {
            /* let { data } = await axios.post(`http://localhost:8000/${}`);

            if( data ){

            } */

        } catch (error) {
            console.log(error);
        }
    }

  return (
    <AuthenticatedLayout user = { auth.user }>
        <div className="container">
            <div className="row mt-5 d-flex justify-content-center ">
                {/* post img */}
                <div className="col-6 p-0">
                    <img className="w-100" src={`/storage/${post.image}`} alt="post-image" />
                </div>

                <div className="col-4 p-0 h-full border-[0.5px] border-l-[0px] border-[#363636]">
                    <div className="px-4">
                        <div className="d-flex align-items-center">
                            <div>
                                <a className="text-decoration-none" href={`/profile/${post.user.id}`}>
                                    <img src="{{$post->user->profile-> profileImage() }}" alt="user-image" className="rounded-circle w-50 max-w-[100px]" />
                                </a>
                            </div>    
                            <div className="mx-2 fw-bold">
                                <a className="text-decoration-none" href={`/profile/${post.user.id}`}>
                                    <span className="text-white">{ post.user.username }</span>
                                </a>
                            </div>
                            <span className="fw-bolder">.</span>

                            {
                                (post.user.id !== auth.user.id) ?
                                (<FollowButton user_id={auth.user.id } isFollowed={ isFollowed } />) : null
                            }

                        </div>
                    </div>
                    <div className='my-[10px] w-full p-0 border-[0.5px] border-[#363636]'></div>
                    <div className="d-flex flex-column justify-content-between">
                        <div className="d-flex px-4">
                            <div className=" font-weight-bold">
                                <a className="text-decoration-none fw-bold" href={`/profile/${post.user.id}`}>
                                    <span className="text-white">{ post.user.username }</span>
                                </a>
                            </div>
                            <p className="mx-2 font-weight-bold text-white">{ post.caption }</p>
                        </div>

                        {/* comments */}
                        <div className="px-4">
                            {post.comments.map((comment)=>{
                                return(
                                    <div className="d-flex align-items-baseline gap-2">
                                        <div className="d-flex w-[20%]">
                                            <a className="text-decoration-none" href={`/profile/${ comment.user.id }`}>
                                                <img className="w-25 rounded-circle" src={ comment.user.profile.image } alt="user-profile-image" />
                                            </a>
                                        </div>
                                        <a className="text-decoration-none" href={`/profile/${ comment.user.id }`}>
                                            <p className="fw-bold">{ comment.user.username }</p>
                                        </a>
                                        <p className='m-0 text-white'>{ comment.comment  }</p>
                                        <div>
                                            <svg aria-label="Comment Options" class="x1lliihq x1n2onr6 x1roi4f4" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24"><title>Comment Options</title><circle cx="12" cy="12" r="1.5"></circle><circle cx="6" cy="12" r="1.5"></circle><circle cx="18" cy="12" r="1.5"></circle></svg>
                                        </div>
                                    </div>
                                )
                            })}
                        </div>

                        <div className='my-[10px] w-full p-0 border-[0.5px] border-[#363636]'></div>
                        <div className="px-4 w-full">
                            {/* like-comment icons */}
                            <div className="d-flex gap-1 my-2">
                                <LikeButton liked={ post.likes } post_id={post.id} user_id={auth.user.id} key={post.id} />
                                <a href={`/p/${ post.id }`}>
                                    <svg width="25" viewBox="0 0 32.00 32.00" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000" transform="matrix(-1, 0, 0, 1, 0, 0)rotate(0)" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.384"></g><g id="SVGRepo_iconCarrier"> <title>comment-1</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.00032" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-100.000000, -255.000000)" fill="#ffffff"> <path d="M116,281 C114.832,281 113.704,280.864 112.62,280.633 L107.912,283.463 L107.975,278.824 C104.366,276.654 102,273.066 102,269 C102,262.373 108.268,257 116,257 C123.732,257 130,262.373 130,269 C130,275.628 123.732,281 116,281 L116,281 Z M116,255 C107.164,255 100,261.269 100,269 C100,273.419 102.345,277.354 106,279.919 L106,287 L113.009,282.747 C113.979,282.907 114.977,283 116,283 C124.836,283 132,276.732 132,269 C132,261.269 124.836,255 116,255 L116,255 Z" id="comment-1" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                                </a>
                            </div>

                            <form onSubmit={handleComment} className="d-flex align-items-baseline justify-content-between">
                                <input onChange={handleChange} className="bg-black text-white border-0" id="comment" type="text" name="comment" value={comment.comment} placeholder="Add a comment..." />

                                <button type="submit" className="bg-black border-0 fw-bold text-[#0095f6]">Post</button>
                            </form>
                        </div>
                    </div>

                </div>
        </div>
    </div>
    </AuthenticatedLayout>
  )
}

export default Post