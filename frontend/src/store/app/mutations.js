

export const setUser = (state, payLoad) => {
    
    state.logado = true
    state.token = payLoad.token
    state.user = payLoad.user
    window.localStorage.setItem('USER_TOKEN', JSON.stringify(payLoad.token))
    
}

export const RemoveUser = (state, payLoad) => {
    state.logado = false
    state.token = null
    state.user = null
    window.localStorage.removeItem('USER_TOKEN')
}
    