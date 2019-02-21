const funcs = {
  getApiData(service, catm) {
    const infoApi = `./getApi.php?url=/${service}/${catm}`;
    console.log(`api : http://172.16.21.218/vdc/server/public/api/${service}/${catm}`);
    return new Promise((resolve, reject) => {
      fetch(infoApi)
        .then((response) => {
          console.log('show me res');
          console.log(response);
          // resolve(response.json());
          return response.json();
        })
        .then((json) => {
          console.log('json: ', json);
          const retData = json.data;

          resolve(retData)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
}
