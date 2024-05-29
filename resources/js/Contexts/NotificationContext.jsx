import { createContext, useEffect, useState, useContext } from "react";
axios.defaults.withCredentials = true;

export const NotificationContext = createContext()

export const useNotifications = () => {
    return useContext(NotificationContext);
};
/* 
Hook Personalizado: useNotifications encapsula useContext(NotificationContext) para simplificar y centralizar el acceso al contexto.
Ventajas: Encapsulamiento, reutilización y simplicidad en los componentes consumidores. 
*/

export const NotificationProvider = ({ children }) => { // fill the context with this provider, I am providing of info to the context
    const [notifications, setNotifications] = useState([]);
    
    useEffect(() => {
        window.Echo.channel('notification').listen('MessageNotification', (e) => {
          if(e){
            setNotifications(e.unseenChats);
          }
        });
        
    }, []);

    useEffect(()=>{ // check if I have any chat unread every time I just log in or every time I reload the page (F5)
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
      fetchData();
  }, [])
    
    return (
      <NotificationContext.Provider value={{notifications}}>
        {children}
      </NotificationContext.Provider>
    );
};