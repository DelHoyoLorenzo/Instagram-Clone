import Echo from 'laravel-echo'
import React, { useEffect, useState } from 'react'

function Chat({id, messages, userId, user, authUser}) {
    
    const [chatMessages, setMessages] = useState(messages)
    const [receiverUser, setReceiverUser] = useState(user)
    const [chatId, setChatId] = useState(id)
    const [receiverUserId, setReceiverUserId] = useState(userId)
    const [userAuth, setUserAuth] = useState(authUser)

    useEffect(()=>{
        Echo.channel('chat').listen('MessageSent', (e)=>{
            console.log(e)

        });

    }, [])

    const [values, setValues] = useState({
        content: "",
    })

    function handleChange(e) {
        const key = e.target.id;
        const value = e.target.value
        setValues(values => ({
            ...values,
            [key]: value,
        }))
      }

    console.log(values.content)
    const sendMessage = async (e) => {
        e.preventDefault();

        let info = {
            content: values.content,
            sender_user_id: userAuth.id,
            receiver_user_id: receiverUserId,
            chat_id: chatId
        }

        try {

            let { data } = await axios.post(`http://localhost:8000/api/eventMessage/${chatId}`, info)
            if(data){
                console.log(data)
                let { messages, receiverUserId, chatId, receiverUser, user } = data;
                // append the messages into the component
            }
        } catch (error) {
            console.log(error);
        }
    }

   console.log()
  return (
    <div class="d-flex flex-column justify-content-between w-full" /* style="max-height: 100vh;" */>
        <div class="p-3 px-2 border-b-[2px] border-[#202020]" >
            <a href="/messages/{{ $chatId }}" class="text-decoration-none" id="chatLink">
                <div class="d-flex gap-2 align-items-center ">
                    <div className='w-[10%]'>
                        <img class="w-100 rounded-circle" src="{{ $receiverUser->profile->profileImage() }}" alt="receiver-profile-picture" />
                    </div>
                    <p class="m-0">{receiverUser.username}</p>
                </div>
            </a>
        </div>
        <div class="px-2 mb-[10px] overflow-y-scroll max-h-full" /* style="overflow-y: auto; overflow-x: hidden; margin-bottom:10px;" */>
            {chatMessages?.map((message, index) => (
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
            <div class="row">
                {/* {{-- left side --}} */}
                <div id="left-messages" class="col-md-6 py-1">
                    <div id="receiver-messages" class="d-flex flex-column align-items-md-start gap-2">
                        
                    </div>
                </div>

                {/* {{-- right side --}} */}
                <div id="right-messages" class="col-md-6 py-1">
                    <div id="sender-messages" class="d-flex flex-column align-items-end justify-content-end gap-2">

                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 border-1 bg-body p-2">
            <form onSubmit={sendMessage}>
                <label htmlFor="content"></label>
                <input id="content" value={values.content} onChange={handleChange} />
                <button class="m-1 bg-body border-0 fw-bold text-[#0095f6]" type="submit">Send</button>
            </form>
        </div>
    </div>
  )
}

export default Chat