import { createContext, useEffect, useState, useContext } from "react";

export const NotificationContext = createContext()

export const useNotifications = () => {
    return useContext(NotificationContext);
};
/* Hook Personalizado: useNotifications encapsula useContext(NotificationContext) para simplificar y centralizar el acceso al contexto.
Ventajas: Encapsulamiento, reutilización y simplicidad en los componentes consumidores. */

export const NotificationProvider = ({ children }) => { // fill the context with this provider, I am providing of info to the context
    const [notifications, setNotifications] = useState([]);
  
    useEffect(() => {
        // if a new message is created, then I notify the logged user
        window.Echo.channel('notification').listen('MessageNotification', (e) => {
          console.log(e.notificationMessage)
          
          setNotifications(e.notificationMessage);
        });

        // I should check if there are any messages unseen
            // execute an endpoint and see if any chat has unseen messages
            

    }, []);
    

    return (
      <NotificationContext.Provider value={{notifications}}>
        {children}
      </NotificationContext.Provider>
    );
};