import Axios from 'axios';

const funcs = {
  getApiData() {
    const api = 'https://a-nuphasupit58.000webhostapp.com/select.php';
    Axios.get(api)
      .then((response) => {
        const returnData = response.data
        console.log(returnData);
      })
  },
  sendData(data) {
    const api = 'https://a-nuphasupit58.000webhostapp.com/save.php';
    console.log(data);
    Axios.post(api, { data })
      .then((response) => {
        console.log('response', response);
      })
  },
}
export default funcs
