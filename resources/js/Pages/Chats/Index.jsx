import React, { useEffect, useState } from 'react';
import { useNotifications } from '@/Contexts/NotificationContext';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Chat from '@/Components/Chat'
import axios from 'axios';

axios.defaults.withCredentials = true;

function Index({chats, auth}) {
    
    let { notifications } = useNotifications();
    
    useEffect(()=>{
    
    }, [])

    const retreiveChatData = async (chatId) => {
        try {
            let { data } = await axios.get(`http://localhost:8000/messages/${chatId}`)
            
            if(data){
                let { messages, receiverUserId, chatId, receiverUser, user } = data;

                setReceiverUser(receiverUser);
                setReceiverUserId(receiverUserId);
                setMessages(messages);
                setChatId(chatId);
                setAuthUser(user);
            }
            
        } catch (error) {
            console.log(error);
        }
    }       
        
    const [receiverUser, setReceiverUser] = useState(undefined)
    const [receiverUserId, setReceiverUserId] = useState(undefined)
    const [messages, setMessages] = useState(undefined)
    const [chatId, setChatId] = useState(undefined)
    const [authUser, setAuthUser] = useState(undefined)

  return (
    <AuthenticatedLayout user={auth.user}>
        <div class="d-flex h-screen">
            <div id="inbox-chats" class="col-4 d-flex flex-column h-screen border-r-[2px] border-[#202020]" >
                <div class="">
                    <div className='px-4 pt-4'>
                        <h2 className='text-white'>{ auth.user.username }</h2>
                        <p class="py-2 text-white">Messages</p>
                    </div>
                    {chats.map((chat) => {
                        let userAuth = auth.user;
                        let receiverUser = chat.users.find((user) => user.id !== userAuth.id);

                        /* let hasUnseenMessages = notifications.some( message => message.chat_id === chat.id) */

                        {/* TODO: check if the chat is filled */}

                        return (
                            <div key={chat.id} id="chats" className="d-flex justify-content-between items-center px-4 hover:bg-[#262626]">
                                {/* <a href={`/messages/${chat.id}`} className="text-decoration-none" id="chatLink"> */}
                                    {/* make a function that calls an api endpoint where I get data an with that data therefore render the chat in the section below */}
                                    <div onClick={() => retreiveChatData(chat.id)} className={`d-flex gap-2 align-items-center cursor-pointer`}>
                                        <div className="w-25">
                                            <img className="w-100 rounded-circle" /* src={receiverUser.profile.profileImage} */ alt="receiver-profile-picture" />
                                        </div>
                                        <p className="m-0 text-white">{receiverUser.username}</p>
                                    </div>
                                    {/* { hasUnseenMessages ? <span className='w-1 h-1 rounded-full bg-[#0095F6]'></span> : null } */}
                                    
                                {/* </a> */}
                            </div>
                        );
                    })}
                </div>
            </div>
            
            {messages !== undefined && receiverUserId !== undefined && chatId !== undefined ? (
                <Chat id={chatId} messages={messages} userId={receiverUserId} user={receiverUser} authUser={authUser} />
            )
               :
            (
            <div class="col-8 d-flex flex-column align-items-center ">
                <div class="d-flex flex-column align-items-center py-4">
                    <h4 className='text-white'>Your messages</h4>
                    <p className='text-white'>Send a message to start a chat.</p>
                    <button class="btn btn-primary">Send message</button>
                </div>
            </div>)}
        </div>
    </AuthenticatedLayout>
  )
}

export default Index