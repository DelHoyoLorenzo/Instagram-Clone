import { useNotifications } from '@/Contexts/NotificationContext';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import Index from '@/Pages/Chats/Index';
import Echo from 'laravel-echo'
import React, { useEffect, useState } from 'react'

function Chat({ chats, chatId, messages, userId, user, receiverUser, auth }) {
    /* ['messages'=>$messages, 'chatId'=>$chat_id , 'user'=>$user,'receiverUser'=>$receiver_user, 'receiverUserId'=>$receiver_id] */
    // const { dispatch } = useNotifications();

    const [chatMessages, setChatMessages] = useState(messages);
    const [newMessages, setNewMessages] = useState([])

    const [values, setValues] = useState({
        content: "",
    })

    useEffect(()=>{
        const messagesDiv = document.getElementById('messages');

        if(messagesDiv){
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        }
        // swap seen attribute to true
        setSeenMessages();
        
        /*  window.Echo.channel('chat').listen('MessageSent', (e) => { */

        window.Echo.private(`chat.${auth.user.id}.${receiverUser.id}`) .listen('MessageSent', (e) => {
            console.log(authUser.id)
            console.log(e)
            setNewMessages(prevMessages => [...prevMessages, e.eventMessage]);
            if(e.eventMessage.sender_user_id !== authUser.id){
                setSeenMessages();
            }
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
        
        
        /* return () => {
            Echo.leave(`chat.${authUser.id}`);
        }; */
    }, [])
    
    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setValues(values => ({
            ...values,
            [key]: value,
        }))
      }

    const sendMessage = async (e) => {
        e.preventDefault();

        let info = {
            content: values.content,
            sender_user_id: userAuth.id,
            receiver_user_id: receiverUser.id,
            chat_id: chatId
        }

        try {
            let { data } = await axios.post(`http://localhost:8000/api/eventMessage/${chatId}`, info)
            if(data){
                // clear the input
                setValues({
                    content:""
                })
            }
        } catch (error) {
            console.log(error);
        }
    }

    async function setSeenMessages(){
        let info = {
            userId: auth.user.id,
        }

        try {
            let { data } = await axios.get(`http://localhost:8000/api/seen/${chatId}`, info);

            if(data){
                console.log('se setearon en seen los mensajes, despacho la action')
                dispatch({ type: 'FETCH_NOTIFICATIONS' });
            }
        
        } catch (error) {
            console.log(error.message)    
        }
    }

  return (
    <Index chats={ chats } auth={ auth }>

    {console.log(receiverUser.profile)}

    { chatMessages ? (<div class="d-flex flex-column justify-content-between w-full max-h-full">
        <div class="p-3 px-2 border-b-[2px] border-[#202020]" >
            <a href="/messages/{{ $chatId }}" class="text-decoration-none" id="chatLink">
                <div class="d-flex gap-2 align-items-center text-white">
                    <div className='w-[10%]'>
                        <img class="w-100 rounded-circle" src={ receiverUser.profile?.image } alt="receiver-profile-picture" />
                    </div>
                    <p class="m-0">{receiverUser.username}</p>
                </div>
            </a>
        </div>
        <div id="messages" class="px-2 mb-[10px] overflow-x-hidden overflow-y-scroll max-h-full">
            {chatMessages.map((message, index) => (
                <div key={index} className="w-full">
                    {userAuth.id !== message.sender_user_id && (
                        <div className="py-1">
                            <div className="d-flex align-items-center gap-2">
                                <div id="receiver-profile-picture">
                                    {/* <a href={`/profile/${message.chat.users.find(user => user.id === message.sender_user_id).profile.id}`}>
                                        <img className="rounded-circle w-100" src={message.chat.users.find(user => user.id === message.receiver_user_id).profile.profileImage()} alt="logged-in-user-profile-picture" />
                                    </a> */}
                                </div>
                                <p className="m-0 text-white p-2 rounded-lg bg-[#292929]">{message.content}</p>
                            </div>
                        </div>
                    )}
                    {userAuth.id === message.sender_user_id && (
                        <div className="py-1">
                            <div className="d-flex align-items-center justify-content-end gap-2">
                                <p className="m-0 text-white p-2 rounded-xl bg-[#3797F0]">{message.content}</p>
                            </div>
                        </div>
                    )}
                </div>
            ))}

            {/* {{-- event messages section --}} */}

            {newMessages ? (newMessages.map((m)=> {
                return (userAuth.id === m.sender_user_id) ?
                (
                    <div key={m.id} className="py-1">
                    <div className="d-flex align-items-center justify-content-end gap-2">
                        <p className="m-0 text-white p-2 rounded-xl bg-[#3797F0]">{m.content}</p>
                    </div>
                </div>
                ) 
                : 
                (<div key={m.id} className="py-1">
                    <div className="d-flex align-items-center gap-2">
                        <div id="receiver-profile-picture">
                            {/* <a href={`/profile/${message.chat.users.find(user => user.id === message.sender_user_id).profile.id}`}>
                                <img className="rounded-circle w-100" src={message.chat.users.find(user => user.id === message.receiver_user_id).profile.profileImage()} alt="logged-in-user-profile-picture" />
                                </a> */}
                        </div>
                        <p className="m-0 text-white p-2 rounded-lg bg-[#292929]">{m.content}</p>
                    </div>
                </div>
                )
                }
            )
            ): null}
        </div>

        <div class="w-100 p-2">
            <form onSubmit={sendMessage} className='flex w-100 justify-content-between border-[2px] border-[#404040] rounded-xl p-1'>
                <div>
                    <label htmlFor="content"></label>
                    <input id="content" value={values.content} onChange={handleChange} className='flex-start bg-black border-none w-100 text-white' placeholder="Message..." />
                </div>
                <button class="flex-end m-1 border-0 fw-bold text-[#0095f6]" type="submit">Send</button>
            </form>
        </div>
    </div>) 
    
    :

    (<div className="col-8 d-flex flex-column align-items-center ">
        <div class="d-flex flex-column align-items-center py-4">
            <h4 className='text-white'>Your messages</h4>
            <p className='text-white'>Send a message to start a chat.</p>
            <button class="text-white mx-2 bg-[#0095F6] p-2 rounded-md">Send message</button>
        </div>
    </div>)}
    
    </Index>
  )
}

export default Chat