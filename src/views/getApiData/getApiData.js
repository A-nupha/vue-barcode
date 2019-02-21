import Axios from 'axios';


const funcs = {
  getApiData() {
    const infoApi = '/select.php';
    return new Promise((resolve, reject) => {
      Axios.get(infoApi)
        // .then((response) => {
        //   console.log('show me res');
        //   console.log(response)
        // })
        .then((response) => {
          console.log('response: ', response);
          // const retData = json.data;

          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
}
export default funcs
