import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom/client';
import { render } from 'react-dom';


function LikeButton(props) {
    const { post_id, user_id, liked } = props
    console.log(JSON.parse(liked)[0].like)
    console.log(post_id)
    console.log(user_id)
    const [isLiked, setIsLiked] = useState(()=>{
        const foundLike = JSON.parse(liked).some((like) => like.user_id === +user_id && like.like);
        console.log(foundLike);
        return foundLike
    });
    
    useEffect(() => {
        // Check if the user has liked a post
        const foundLike = JSON.parse(liked).some((like) => like.user_id === +user_id && like.like);;
        // Update isLiked based on whether the user has liked the post
        setIsLiked(foundLike);
    }, []);
    
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
    
    console.log(isLiked);
  return (
    <div onClick={ likePost }>
        { !isLiked ? <svg width="25" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Stock_cut" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><desc></desc><path d="M28.343,17.48L16,29 L3.657,17.48C1.962,15.898,1,13.684,1,11.365v0C1,6.745,4.745,3,9.365,3h0.17c2.219,0,4.346,0.881,5.915,2.45L16,6l0.55-0.55 C18.119,3.881,20.246,3,22.465,3h0.17C27.255,3,31,6.745,31,11.365v0C31,13.684,30.038,15.898,28.343,17.48z" fill="none" stroke="#ffffff" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"></path></g></svg> : <svg width="25" fill="#FF3040" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg" stroke="#FF3040"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M1771.731 291.037C1675.709 193.659 1547.944 140 1411.818 140h-.113c-136.125 0-263.777 53.66-359.573 150.924-37.618 38.07-68.571 80.997-92.294 127.426-23.61-46.429-54.563-89.356-92.068-127.313C771.86 193.659 644.208 140 507.97 140h-.113c-136.012 0-263.777 53.66-359.8 151.037-197.691 200.629-197.691 527.103 1.695 729.088l810.086 760.154 811.893-761.736c197.692-200.403 197.692-526.877 0-727.506" fill-rule="evenodd"></path> </g></svg>}
    </div>
    
  )
}


export default LikeButton;

document.querySelectorAll('.likeButton').forEach(likeButtonElement => {
    const postId = likeButtonElement.getAttribute('post_id');
    const liked = likeButtonElement.getAttribute('liked');
    const userId = likeButtonElement.getAttribute('user_id');
    const key = likeButtonElement.getAttribute('key');

    const Index = ReactDOM.createRoot(likeButtonElement);

    Index.render(
        <React.StrictMode>
            <LikeButton post_id={postId} liked={liked} user_id={userId} key={key} />
        </React.StrictMode>
    );
});