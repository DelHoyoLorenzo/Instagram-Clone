import React, { useState } from 'react';

function FollowButton({user_id, isFollowed}) {

    const [status, setStatus] = useState(isFollowed); //it must be global, or storaged. If I refresh the page the value resets
    
    const followUser = (user_id) =>
    {
        axios.post(`http://localhost:8000/follow/${user_id}`)
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
            { status ? <button class="bg-[#1877F2] p-2 rounded-md mx-2 text-white" onClick={()=>followUser(user_id)}> Unfollow </button> : <button class="bg-[#1877F2] p-2 rounded-md mx-2 text-white" onClick={()=>followUser(user_id)}> Follow </button>}
        </div>
    );
}

export default FollowButton;
