import Axios from 'axios';
import store from '../../store/store'

const funcs = {

  login(userName, passWord) {
    console.log('data', userName);
    // eslint-disable-next-line no-var
    var api = 'https://a-nuphasupit58.000webhostapp.com/php/login.php';
    // eslint-disable-next-line no-var
    var params = new URLSearchParams();
    params.append('userName', userName)
    params.append('passWord', passWord)
    console.log('params', params)
    Axios.post(api, params)
      .then((response) => {
        alert(response.data)

      })
  },
  search() {
    return new Promise((resolve, reject) => {
      const api = 'https://a-nuphasupit58.000webhostapp.com/php/select.php';
      Axios.get(api)
        .then((response) => {
          // const retData = response.data
          // console.log('value', retData)
          // store.state.dataSelect = retData
          resolve(response);
        // retData.forEach((value) => {
        //   // console.log(value.pid)
        //   // console.log(retData[0].pid);
        //   // const data = store.state
        //   // store.state.userName = value.index1
        //   // store.state.password = value.index2
        // })
        })
        .catch(function (error) {
          reject(error)
        })
    })
  },

  save(data) {
    // eslint-disable-next-line no-var
    var api = 'https://a-nuphasupit58.000webhostapp.com/php/save.php';
    // eslint-disable-next-line no-var
    var params = new URLSearchParams();
    params.append('bdate', data.bdate)
    params.append('email', data.email)
    params.append('flag_id', data.flag_id)
    params.append('fname', data.fname)
    params.append('index1', data.username)
    params.append('index2', data.password)
    params.append('lname', data.lname)
    params.append('now_date', data.now_date)
    params.append('pid', data.pid)
    params.append('rcode_id', data.rcode_id)
    params.append('tel', data.tel)
    params.append('tname', data.tname)
    console.log('params', params)
    Axios.post(api, params)
      .then((response) => {
        console.log(response);
        if (response.data === true) {
          alert('บันทึกสำเร็จ');
          return 'บันทึกสำเร็จ'
        } if (response.data === false) {
          alert('บันทึกล้มเหลว กรุณาตรวจสอบข้อมูล');
          return 'บันทึกล้มเหลว กรุณาตรวจสอบข้อมูล'
        }
      })
  },
}
export default funcs
