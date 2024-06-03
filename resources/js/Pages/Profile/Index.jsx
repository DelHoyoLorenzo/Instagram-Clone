import React, { useState } from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import FollowButton from '@/Components/FollowButton'

function Index({ user, followers, following, profile, auth }) {
    // user could be either the authUser or a different one, profile is the profile I am retreiveng, it could be either the auth one or a different one
    console.log(user)
    
    const [isFollowed, setIsFollowed] = useState(false);
    
    following.map((following)=>{
        if(following.user_id == profile.user_id){
            setIsFollowed(true)
        }
    })

  return (
    <AuthenticatedLayout user={auth.user}>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-3 p-5">
                    <img src={`${user.profile.profileImage}`} alt="profile-image" class="rounded-circle w-100" />
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
                            
                            <a href="/messages/{{ $user->profile->user_id }}">
                                <button class="mx-2 text-white bg-[#1877F2] p-2 rounded-md">Message</button>
                            </a>
                            {/* #262626 bg button color -- */}
                            {/* @can ('update', user.profile)
                                <a href="/profile/{{ $user->id }}/edit"><button class="mx-2 btn btn-primary">Edit Profile</button></a>
                            @endcan
                            @can ('update', $user.profile)
                            <a href="/p/create"><button class="mx-2 btn btn-primary">New Post</button></a>
                            @endcan */}
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
                    <div><a href="{{$user->profile->url}}" target="_blank">{ user.profile.url || 'link'}</a></div>
                </div>
                <hr class="mt-5" />
            </div>
            <div class="row pt-5">
                {user.posts.map((post)=>{
                    return(
                        <div class="col-4">
                            <a class="w-10 text-decoration-none" href={`/p/${post.id}`}>
                                {post.image ? (
                                    <img class="w-100 rounded" src={`/storage/${ post.image }`} alt="post-image" />
                                ) : (
                                    <p>No image available</p>
                                )}
                            </a>
                        </div>
                    )
                })}
            </div>
        </div>
    </AuthenticatedLayout>
  )
}

export default Index