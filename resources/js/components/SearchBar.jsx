import { Link } from '@inertiajs/react';
import React, { useEffect, useState } from 'react'

function SearchBar() {
    const [users, setUsers] = useState(null)
    const [visitedProfiles, setVisitedProfiles] = useState(null)

    useEffect(()=>{
        fetchVisitedProfiles()
    }, [])

    const fetchVisitedProfiles = async () => {
        try {
            let { data } = await axios.get(`http://localhost:8000/getVisitedProfiles`)

            if(data){
                setVisitedProfiles(data.visitedProfiles)
            }
        } catch (error) {
            console.log(error)
        }
    }

    const setRecentChats = async (profileId) => {
        try {
            let { data } = await axios.get(`http://localhost:8000/visitProfile/${profileId}`)

            if(data){
                console.log(data)
            }
        } catch (error) {
            
        }
    }
    
    const searchUsers = async (event) => {
        const value = event.target.value;

        try {
        if(value){ // avoid making a request with an empty search bar
            let { data } = await axios.get(`http://localhost:8000/search/${value}`)

            if(data){
                setUsers(data.users)
            }
        }else{
            setUsers([])
        }
       } catch (error) {
           console.log(error)
           setUsers(null);
       }
        
    }

  return (
    <div className='flex flex-column border-r-[2px] border-[#202020]'>
        <h2 className='text-white p-2'>Search</h2>

        <input type='search' onChange={searchUsers} className='bg-[#262626] text-white rounded-lg border-none m-2 focus:outline-none' placeholder='Search'/>
        
        <div className='my-[10px] w-full p-0 border-[0.1px] border-[#363636]'></div>

        <div className=''>
            { users && users.length ? (
                users.map((user)=>{
                    return(
                        <Link href={`/profile/${user.profile.id}`} onClick={ ()=> setRecentChats(user.profile.id) } className='text-decoration-none'>
                            <div className='flex items-center gap-1 p-2 hover:bg-[#262626]'>
                                    <div>
                                            <img className="w-6 rounded-[50%]" src={`/storage/${user.profile.image}`} alt="user-profile-image" />
                                    </div>
                                    <div className='flex flex-column items-start'>
                                        <p className='text-white m-0'>{user.username}</p>
                                        <p className='text-[#A8A8A8] m-0'>{user.name}</p>
                                    </div>

                            </div>
                        </Link>
                    )
                })
            ) : 
                <div className=''>
                    <h3 className='text-white'>Recent</h3>
                    {<div>
                        {visitedProfiles ? (
                            visitedProfiles?.map(({profile, user})=>{
                                return(
                                    <Link href={`/profile/${profile.id}`} onClick={ ()=> setRecentChats(profile.id) } className='text-decoration-none'>
                                        <div className='flex items-center gap-2 p-2 hover:bg-[#262626] p-2'>
                                            <div>
                                                <img className="w-6 rounded-[50%]" src={`/storage/${profile.image}`} alt="user-profile-image" />
                                            </div>
                                            <div className='flex flex-column items-start'>
                                                <p className='text-white m-0'>{user.username}</p>
                                                <p className='text-[#A8A8A8] m-0'>{user.name}</p>
                                            </div>
                                        </div>
                                    </Link>
                                )
                            })
                        ) : null}
                    </div>}
                </div>
            }
        </div>
    </div>
  )
}

export default SearchBar