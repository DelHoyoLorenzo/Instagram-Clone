import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom/client';

function LikeButton(props) {
    const { post_id, user_id, liked } = props

    const [isLiked, setIsLiked] = useState(()=>{
        const foundLike = JSON.parse(liked).some((like) => like.user_id === +user_id && like.like);
        return foundLike
    });
    
    useEffect(() => {
        // Check if the user has liked a post
        const foundLike = JSON.parse(liked).some((like) => like.user_id === +user_id && like.like);;
        // Update isLiked based on whether the user has liked the post
        setIsLiked(foundLike);
    }, [liked]);
    
    const likePost = () =>
    {
        axios.post(`/like/${post_id}`,{
            'like': true,
            'post_id': post_id,
        })
        .then(response => {
            setIsLiked(!isLiked)
        })
        .catch(errors => {
            
        });
    }
  return (
    <div onClick={ likePost }>
        { !isLiked ? <svg width="25" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Stock_cut" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><desc></desc><path d="M28.343,17.48L16,29 L3.657,17.48C1.962,15.898,1,13.684,1,11.365v0C1,6.745,4.745,3,9.365,3h0.17c2.219,0,4.346,0.881,5.915,2.45L16,6l0.55-0.55 C18.119,3.881,20.246,3,22.465,3h0.17C27.255,3,31,6.745,31,11.365v0C31,13.684,30.038,15.898,28.343,17.48z" fill="none" stroke="#ffffff" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"></path></g></svg> : <svg width="30" fill="#FF3040" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M26.996 12.898c-.064-2.207-1.084-4.021-2.527-5.13-1.856-1.428-4.415-1.69-6.542-.132-.702.516-1.359 1.23-1.927 2.168-.568-.938-1.224-1.652-1.927-2.167-2.127-1.559-4.685-1.297-6.542.132-1.444 1.109-2.463 2.923-2.527 5.13-.035 1.172.145 2.48.788 3.803 1.01 2.077 5.755 6.695 10.171 10.683l.035.038.002-.002.002.002.036-.038c4.415-3.987 9.159-8.605 10.17-10.683.644-1.323.822-2.632.788-3.804z"></path></g></svg>}
    </div>
  )
}

export default LikeButton;

const likeButtonElement = document.getElementById('LikeButton');

if (likeButtonElement) {
    const Index = ReactDOM.createRoot(document.getElementById("LikeButton"));
    const post_id = likeButtonElement.getAttribute('post_id');
    const liked = likeButtonElement.getAttribute('liked');
    const user_id = likeButtonElement.getAttribute('user_id');
    const key = likeButtonElement.getAttribute('key');
    Index.render(
        <React.StrictMode>
            <LikeButton post_id={post_id} liked={liked} user_id={user_id} key={key} />
        </React.StrictMode>
    )
}