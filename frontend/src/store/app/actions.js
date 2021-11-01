import { api } from 'boot/axios'
import { Notify } from 'quasar'
export const LOGIN = async ({ commit, dispatch }, payload) => {

    await api.post('/login', payload)
        .then(response => {
            const data = response.data
            commit('setUser', data)
            api.defaults.headers.common.Authorization = 'bearer ' + data.token
           const dismiss= Notify.create({ timeout: 0, message: 'dsdsdsdsdsdsd' })
            dismiss();

        })
        .catch(error => {
            const message = error.response ? error.response.data.message : error.request ?
                `Erro ao tentar comunicar com servidor: ${error.message}` :
                `Erro ao fazer requisição ao servidor: ${error.message}`

                

            const alerta = Notify.create({
                position: "top",
                timeout: 0,
                icon: "ion-close",
                color: "negative",
                message:message,
                progress: true,
                actions: [{ icon: "close", color: "white" }],
            });
          
            return Promise.reject(error);
        })


}


export const LOGOUT = ({ commit }) => {
    api.defaults.headers.common.Authorization = ''
    commit('removeToken')
}

// function msgError(message ) {


//     const alerta =  Notify.create({
//         position: "top",
//         timeout: 0,
//         icon: "ion-close",
//         color: "negative",
//         message: message,
//         progress: true,
//         actions: [{ icon: "close", color: "white" }],
//     });
// return alerta;


// }
