import React, { useState } from 'react';
import ReactDOM from 'react-dom/client';

function SideBar() {
    
    return (
        <div>
            SIDE BAR
        </div>
    );
}

export default SideBar;

const SideBar = document.getElementById('SideBar');
if (SideBar) {
    const Index = ReactDOM.createRoot(document.getElementById("FollowButton"));
    Index.render(
        <React.StrictMode>
            <SideBar />
        </React.StrictMode>
    )
}