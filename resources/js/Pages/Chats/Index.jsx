import React, { useEffect, useState } from 'react';
import { useNotifications } from '@/Contexts/NotificationContext';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Chat from '@/Pages/Chats/Chat'
import axios from 'axios';
import { Link } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';

axios.defaults.withCredentials = true;

function Index({ chats, auth, children }) {
    const { url, component } = usePage();
    const [notifications, setNotifications] = useState([]);

    const array = url.split('/')
    const currentChatId = Number(array.at(-1))

    const fetchData = async () =>{ 
        try {
            let { data } = await axios.get(`http://localhost:8000/checkChatsNotifications`)
      
            if(data){
                setNotifications(data);
            }
        } catch (error) {
            console.log(error)
        }
    }

    useEffect(() => {
        // seting notifications when the view is loaded for the first time or after pressing F5
        fetchData();

        // listening for notifications if a message is received while Im on the app
        window.Echo.private('notification.' + auth.user.id ).listen('MessageNotification', (e) => {
          if(e){
            setNotifications(e.unseenChats);
          }
        });
        
    }, []);
    
  return (
    <AuthenticatedLayout user={auth.user}>
        <div className="d-flex h-screen">
            <div id="inbox-chats" class="col-4 d-flex flex-column h-screen border-r-[2px] border-[#202020]" >
                <div className="">
                    <div className='px-4 pt-4'>
                        <h2 className='text-white'>{ auth.user.username }</h2>
                        <p className="py-2 text-white">Messages</p>
                    </div>
                    {chats.map((chat) => {
                        let receiverUser = chat.users.find((user) => user.id !== auth.user.id);

                        let hasUnseenMessages = notifications?.some( chatId => chatId === chat.id)

                        {/* TODO: check if the chat is filled */}
                        return (
                            <div key={chat.id} id="chats" className={`d-flex justify-content-between items-center px-4 min-h-[72px] hover:bg-[#262626] ${ currentChatId === chat.id && 'bg-[#262626]'}`}>
                                <Link href={`/t/${chat.id}`} className="text-decoration-none" id="chatLink">
                                    <div className={`d-flex gap-2 align-items-center justify-between cursor-pointer`}>
                                        <div className='flex items-center gap-2'>
                                            <div className="w-25">
                                                <img className="w-100 rounded-circle" src={ `/storage/${receiverUser.profile?.image}` } alt="receiver-profile-picture" />
                                            </div>
                                            <p className="m-0 text-white">{receiverUser.username}</p>
                                        </div>
                                        { hasUnseenMessages ? <div className='w-1 h-1 rounded-full bg-[#0095F6]'></div> : null }
                                    </div>
                                    
                                </Link>
                            </div>
                        );
                    })}
                </div>
            </div>

            { children || 
            (<div className="col-8 d-flex flex-column align-items-center ">
                <div class="d-flex flex-column align-items-center py-4">
                    <h4 className='text-white'>Your messages</h4>
                    <p className='text-white'>Send a message to start a chat.</p>
                    <button class="text-white mx-2 bg-[#0095F6] p-2 rounded-md">Send message</button>
                </div>
            </div>) }

        </div>
    </AuthenticatedLayout>
  )
}

export default Index