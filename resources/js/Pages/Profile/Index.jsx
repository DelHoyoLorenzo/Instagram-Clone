import React, { useState } from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import FollowButton from '@/Components/FollowButton'
import { Link } from '@inertiajs/react'

function Index({ user, followers, following, auth, isFollowed }) {
    // user could be either the authUser or a different one, profile is the profile I am retreiveng, it could be either the auth one or a different one
    const createChat = () => {
        axios.get(`http://localhost:8000/chats/${ user.profile.user_id }`)
        .then((response)=>{
            console.log(response)
        })
    }

  return (
    <AuthenticatedLayout user={auth.user}>
        <div class="container">
            <div class="row justify-content-center">
                <div class="relative col-3 pt-5 h-[150px] w-[150px]">
                    <img src={`/storage/${user.profile.image}`} alt="profile-image" className="top-0 rounded-[50%] h-full w-full object-fit-fill " />
                </div>
                <div class="col-6 pt-5">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div class="d-flex align-items-center my-4">
                            <h4 className='text-white'>{user.username}</h4>
                            {
                                (user.id !== auth.user.id) ?
                                    <FollowButton user_id={ user.id } isFollowed={ isFollowed } />
                                : 
                                    null
                            }
                    
                            {
                            (user.id === auth.user.id) ?
                            (<div className='flex '>
                                <Link href={`/profile/${ user.id }/edit`}>
                                    <button class="text-white mx-2 bg-[#262626] p-2 rounded-md">Edit Profile</button>
                                </Link>
                                <Link href={`/p/create`}>
                                    <button class="text-white mx-2 bg-[#262626] p-2 rounded-md">New Post</button>
                                </Link>
                            </div>
                            ) : 
                            (
                            <Link href={`/chats/${ user.profile.user_id }`}>
                                <button /* onClick={createChat} */ class="text-white mx-2 bg-[#262626] p-2 rounded-md">Message</button>
                            </Link>
                            )
                            }
                        </div>
                    </div>
        
        
                    <div class="col-4 d-flex gap-5">
                        <div class="d-flex gap-1 text-white">
                            <strong>{ user.posts.length }</strong>
                            <p>posts</p>
                        </div>
                        <div class="d-flex gap-1 text-white">
                            <strong>{ followers.length }</strong>
                            <p>followers</p>
                        </div>
                        <div class="d-flex gap-1 text-white">
                            <strong>{ following.length }</strong>
                            <p>following</p>
                        </div>
                    </div>
                    <div class="pt-4 font-weight-bold text-white">{ user.profile.title }</div>
                    <div className='text-white'>{ user.profile.description }</div>
                    <div><a href={`${user.profile.url}`} target="_blank">{ user.profile.url || 'link'}</a></div>
                </div>
                <hr class="mt-5" />
            </div>
            <div class="row pt-5">
                {user.posts.map((post)=>{
                    return(
                        <div key={post.id} class="col-4">
                            <Link class="w-10 text-decoration-none" href={`/p/${post.id}`}>
                                {post.image ? (
                                    <img class="w-100 rounded" src={`/storage/${ post.image }`} alt="post-image" />
                                ) : (
                                    <p>No image available</p>
                                )}
                            </Link>
                        </div>
                    )
                })}
            </div>
        </div>
    </AuthenticatedLayout>
  )
}

export default Index