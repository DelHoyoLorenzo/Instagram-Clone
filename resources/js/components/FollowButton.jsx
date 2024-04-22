import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';

function FollowButton({user_id}) {
    
    const [status, setStatus] = useState(false); //it must be globall, or storaged. If I refresh the page the value resets
    
    const followUser = (user_id) =>
    {
        axios.post(`/follow/${user_id}`)
        .then(response => {
            console.log(response.data)
            setStatus(!status);
        })
        .catch(errors => {
            if (errors.response.status === 401 ) {
                window.location = '/login' //sent our user back to login if he is unlogged
            }
        });
    }

    return (
        <div>
            { status ? <button class="btn btn-primary mx-2" onClick={()=>followUser(user_id)}> Follow </button> : <button class="btn btn-primary mx-2" onClick={()=>followUser(user_id)}> Unfollow </button>}
            
        </div>
    );
}

export default FollowButton;

const followButtonElement = document.getElementById('FollowButton');

if (followButtonElement) {
    const Index = ReactDOM.createRoot(document.getElementById("FollowButton"));
    const userId = followButtonElement.getAttribute('user_id');
    Index.render(
        <React.StrictMode>
            <FollowButton user_id={userId}/>
        </React.StrictMode>
    )
}
