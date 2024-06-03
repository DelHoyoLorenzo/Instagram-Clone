import { createContext, useEffect, useState, useContext, useReducer } from "react";
axios.defaults.withCredentials = true;

/* const URL = process.env.FRONT_URL;
console.log(URL) */

export const NotificationContext = createContext()

export const useNotifications = () => {
    return useContext(NotificationContext);
};
/* 
Hook Personalizado: useNotifications encapsula useContext(NotificationContext) para simplificar y centralizar el acceso al contexto.
Ventajas: Encapsulamiento, reutilización y simplicidad en los componentes consumidores. 
*/

export const NotificationProvider = ({ children, user }) => { // fill the context with this provider, I am providing of info to the context
    const [notifications, setNotifications] = useState([]);

    const fetchData = async () =>{ // check if I have any chat unread every time I just log in or every time I reload the page (F5)
      try {
          let { data } = await axios.get(`http://localhost:8000/checkChatsNotifications`)
    
          if(data){
              setNotifications(data);
          }
      } catch (error) {
          console.log(error)
      }
    }
    
    const [state, dispatch] = useReducer((state, action) => {
      switch (action.type) {
          case 'FETCH_NOTIFICATIONS':
              fetchData();
              return state;
          default:
              return state;
      }
    }, {});
    
    useEffect(() => {

        //when any view is loaded for the first time
        fetchData();

        window.Echo.private('notification.' + user.id ).listen('MessageNotification', (e) => {
          if(e){
            setNotifications(e.unseenChats);
          }
        });
        
    }, []);
    
    return (
      <NotificationContext.Provider value={{notifications, dispatch}}>
        {children}
      </NotificationContext.Provider>
    );
};