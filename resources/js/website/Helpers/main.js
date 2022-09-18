export function fetchCart(success, error) {
    return axios.get('/api/cart').then(success(result)).catch(error(error))
}

export function basePath() {
    const appUrl = document.querySelector('meta[name=app-url]')
    return appUrl ? appUrl.content + '/' : window.location.origin + '/'
}

export function url(path) {
    return basePath() + path
}
