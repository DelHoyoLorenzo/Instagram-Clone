import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';

function FollowButton({user_id, isFollowed}) {

    const [status, setStatus] = useState(isFollowed); //it must be global, or storaged. If I refresh the page the value resets
    
    const followUser = (user_id) =>
    {
        axios.post(`/follow/${user_id}`)
        .then(response => {
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
            { status ? <button class="btn btn-primary mx-2" onClick={()=>followUser(user_id)}> Unfollow </button> : <button class="btn btn-primary mx-2" onClick={()=>followUser(user_id)}> Follow </button>}
        </div>
    );
}

export default FollowButton;

const followButtonElement = document.getElementById('FollowButton');

if (followButtonElement) {
    const Index = ReactDOM.createRoot(document.getElementById("FollowButton"));
    const userId = followButtonElement.getAttribute('user_id');
    const isFollowed = followButtonElement.getAttribute('isFollowed');
    Index.render(
        <React.StrictMode>
            <FollowButton user_id={userId} isFollowed={isFollowed}/>
        </React.StrictMode>
    )
}
