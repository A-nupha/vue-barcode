/* eslint-disable no-inner-declarations */
import Vue from 'vue'
import axios from 'axios'
import titlePrint from '@cdglib/js-title-print'
import digit, { DigitType, FormatType } from '@cdglib/js-moi-xid'
import popstDesc from '@cdglib/js-popst'
import requestSysDate from '@cdglib/js-system-date'
import moment from 'moment'
// import { CLIENT_RENEG_LIMIT } from 'tls';

let sysDate

export default {
  name: 'functions',
  async startSysDate() {
    sysDate = await requestSysDate()
  },
  moment(date) {
    const year = Number(moment(date).format('YYYY'))
    // console.log(year.length)
    const month = moment(date).format('MM')
    const day = moment(date).format('DD')
    const currentDate = (year + 543) + month + day
    // this.currentDate = currentDate
    return currentDate;
  },
  getSysDate() {
    // eslint-disable-next-line max-len
    return { date: sysDate().getDate(), month: sysDate().getMonth() + 1, year: sysDate().getFullYear() }
  },
  getSysTime() {
    let m = sysDate().getMinutes().toString()
    if (m.length === 1) m = `0${m}`
    let s = sysDate().getSeconds().toString()
    if (s.length === 1) s = `0${s}`
    // eslint-disable-next-line max-len
    return { hour: sysDate().getHours(), minute: m, second: s }
  },
  getFullName(titlesex, titleprint, sexcode, firstname, middlename, lastname) {
    const param = {
      title_sex: titlesex,
      title_print: titleprint,
      sex: sexcode,
      fname: firstname,
      mname: middlename,
      lname: lastname,
    }
    // console.log(param)
    const full = titlePrint.infToPrint(param)
    return full.short
  },
  getNameFormat(name) {
    let recv
    try {
      recv = titlePrint.formatToPrint(name)
    } catch (err) {
      console.log(err.message)
      recv = { short: name }
    }
    return recv
  },
  getPIDformat(pid) {
    if (pid == 0) { return pid }
    return digit.getFormat(pid, DigitType.PID, FormatType.AUTO)
  },
  getHIDformat(hid) {
    if (hid == 0) { return hid }
    return digit.getFormat(hid, DigitType.HID, FormatType.AUTO)
  },
  getDateFormat(date) {
    // console.log(date)
    let day = '-'
    let month = { digit: '-', long: '-', short: '-'}
    let year = '-'
    let long = '-'
    let short = '-'
    let format = {
      day,
      month,
      year,
      long,
      short,
    }
    if (date == 0) {
      return format
    }
    if ((`${date}`).length != 8) {
      // console.log(date)
      long = date
      short = date
      return format
    }
    day = date % 100
    if (day === 0) {
      day = ''
    }
    year = Math.floor(date / 10000)
    let m = Math.floor(date / 100) % 100
    if (m === 0) { m = '' }
    // let mShort = ''
    // let mLong = ''
    m = this.getThaiMonth(m)
    month = { digit: m.digit, long: m.long, short: m.short }
    long = `${day} ${m.long} พ.ศ.${year}`
    short = `${day} ${m.short} ${year}`
    format = {
      day,
      month,
      year,
      long,
      short,
    }
    return format
  },
  getThaiMonth(m) {
    let mShort = ''
    let mLong = ''
    switch (m) {
      case 1:
        mLong = 'มกราคม'
        mShort = 'ม.ค.';
        break
      case 2:
        mLong = 'กุมภาพันธ์'
        mShort = 'ก.พ.';
        break
      case 3:
        mLong = 'มีนาคม'
        mShort = 'มี.ค.';
        break
      case 4:
        mLong = 'เมษายน'
        mShort = 'เม.ย.';
        break
      case 5:
        mLong = 'พฤษภาคม'
        mShort = 'พ.ค.';
        break
      case 6:
        mLong = 'มิถุนายน'
        mShort = 'มิ.ย.';
        break
      case 7:
        mLong = 'กรกฎาคม'
        mShort = 'ก.ค.';
        break
      case 8:
        mLong = 'สิงหาคม'
        mShort = 'ส.ค.';
        break
      case 9:
        mLong = 'กันยายน'
        mShort = 'ก.ย.';
        break
      case 10:
        mLong = 'ตุลาคม'
        mShort = 'ต.ค.';
        break
      case 11:
        mLong = 'พฤศจิกายน'
        mShort = 'พ.ย.';
        break
      case 12:
        mLong = 'ธันวาคม'
        mShort = 'ธ.ค.';
        break
      default:
        mLong = ''
        mShort = mLong
    }
    return { digit: m, long: mLong, short: mShort }
  },
  getThaiYear(y) {
    if (y < 2400) {
      y += 543
    }
    return y
  },
  tranDoc(number) {
    let str = '';
    if (number == 1) {
      str = 'ย้ายออกนอกเขต'
    } else if (number == 2) {
      str = 'ย้ายภายในเขต'
    } else if (number == 3) {
      str = 'ย้ายออกจากการแจ้งย้ายปลายทาง'
    } else if (number == 4) {
      str = 'ย้ายไปต่างประเทศ'
    } else if (number == 5) {
      str = 'ย้ายปลายทางอัตโนมัติ'
    } else if (number == 7) {
      str = 'ย้ายออกจากบ้านชั่วคราว กรณีย้ายเข้าจากต่างประเทศ'
    } else if (number == 8) {
      str = 'ย้ายข้าจากทะเบียนการเกิดของคนไม่มีสถานะทางทะเบียน'
    } else if (number == 0) {
      str = '-'
    } else {
      str = ''
    }
    return str;
  },
  checkMuuFormat(ccaattmm) {
    const muu = ccaattmm % 100
    if (muu == 0) {
      return ' '
    }
    return muu
  },
  getAge(bdate) {
    const bd = this.getDateFormat(bdate)
    if (bd.year === 0 || bd.year === '-') { return '-' }
    let age = (this.getSysDate().year + 543) - bd.year
    // if (age == 0) {
    //   const m = sysDate().getMonth() - bd.month.digit
    //   return `${0}.${m}`
    // }
    if (bd.month === '') { return age }
    if (this.getSysDate().month === bd.month.digit) {
      if (bd.day === '') { return age }
      if (this.getSysDate().date < bd.day) {
        age -= 1
      }
    } else if (this.getSysDate().month < bd.month.digit) {
      age -= 1
    }
    console.log('age ' + age)
    return age
  },
  getTimeFormat(time, noSec = true) {
    try {
      if (time === 0) { return '-' }
      let t = (`0${time}`).slice(-8)
      if (noSec) {
        t = `${t.slice(0, 2)}:${t.slice(2, 4)} น.`
      } else {
        t = `${t.slice(0, 2)}:${t.slice(2, 4)}:${t.slice(4, 6)} น.`
      }
      if (t.startsWith(0)) t = t.slice(1)
      return t
    } catch (e) {
      return e
    }
  },
  getPopSt(popSt, datemo, termDate) { // 0,4,8
    const params = {
      pop_st: popSt,
      datemo,
      term_date: termDate,
    }
    const st = popstDesc.getDesc(params)
    return st
  },
  getPrintPopSt(popSt, ownSt) {
    if (popSt === 0 || popSt === 14 || popSt === 15) {
      if (ownSt === 0) {
        return ('ผู้อาศัย')
      } else if (ownSt === 1) {
        return ('เจ้าบ้าน')
      }
      return (`หัวหน้าครอบครัวที่ ${ownSt}`)
    }
    if (popSt > 0) {
      switch (popSt) {
        case 1: return ('จำหน่ายตาย')
        case 2: return ('จำหน่าย ท.ร. 97')
        case 3: return ('เปลี่ยนสถานภาพ')
        case 4: return ('ย้ายไปต่างประเทศ')
        case 5: return ('จำหน่ายชื่อซ้ำซ้อน')
        case 6: return ('จำหน่ายตามระเบียบ')
        case 7: return ('จำหน่ายชื่อ')
        case 8: return ('ทะเบียนบ้านกลาง')
        case 9: return ('อยู่ระหว่างการย้าย')
        case 10: return ('จำหน่ายเลข')
        case 11: return ('จำหน่ายตายต่างท้องที่')
        case 12: return ('จำหน่ายสละสัญชาติไทย')
        case 13: return ('สละสัญชาติไทยแล้วตาย')
        default: return ('')
      }
    }
    return ('')
  },
  getHouseReprint(status, printDate) {
    if (status === 0) { return '-' }
    let str = `พิมพ์ทะเบียนบ้านแล้ว ${status} ครั้ง ครั้งสุดท้ายเมื่อ `
    str += this.getDateFormat(printDate).long
    return str
  },
  getAddressPrint(no, soi, trok, thanon, tt, aa, cc, catm = 99999999, str = true) {
    let strAddr = ''
    if (no != '') {
      if (str) {
        strAddr += 'บ้านเลขที่ '
      }
      strAddr += `${no}  `
    }
    try {
      if (catm !== 99999999 && Number(catm % 100) !== 0) {
        strAddr += `หมู่ ${Number(catm % 100)}  `
      }
    } catch (e) {
      console.log(e)
    }
    if (soi != '') {
      strAddr += `ซอย${soi}  `
    }
    if (trok != '') {
      strAddr += `ตรอก${trok}  `
    }
    if (thanon != '') {
      strAddr += `ถนน${thanon}  `
    }
    if (tt != '') {
      if (cc == 'กรุงเทพมหานคร') {
        strAddr += `แขวง${tt}  `
      } else {
        strAddr += `ตำบล${tt}  `
      }
    }
    if (aa != '') {
      if (cc == 'กรุงเทพมหานคร') {
        strAddr += `${aa}  `
      } else {
        strAddr += `อำเภอ${aa}  `
      }
    }
    if (cc != '') {
      if (cc == 'กรุงเทพมหานคร') {
        strAddr += `${cc}  `
      } else {
        strAddr += `จังหวัด${cc}`
      }
    }
    return strAddr
  },
  getAddressFormat(addrOut, catDescOut) {
    let str = `${addrOut}#${catDescOut}`
    str = str.split('#')
    let reStr = str[0]
    if (str[1] != '') {
      if (str[1].startsWith('0') || str[1].startsWith(0)) {
        reStr += ` หมู่ ${str[1].substring(1)}`
      } else {
        reStr += ` หมู่ ${str[1]}`
      }
    }
    if (str[2] != '') reStr += ` ตรอก ${str[2]}`
    if (str[3] != '') reStr += ` ซอย ${str[3]}`
    if (str[4] != '') reStr += ` ถนน ${str[4]}`
    if (str[5].startsWith('กรุงเทพ')) {
      if (str[7] != '') reStr += ` แขวง ${str[7]}`
      if (str[6] != '') reStr += ` เขต ${str[6]}`
      if (str[5] != '') reStr += ` ${str[5]}`
    } else {
      if (str[7] != '') reStr += ` ต.${str[7]}`
      if (str[6] != '') reStr += ` อ.${str[6]}`
      if (str[5] != '') reStr += ` จ.${str[5]}`
    }
    return reStr
  },
  noChar(str) {
    if (str == '') {
      str = '-'
    }
    return str
  },
  insertIndex(arr) {
    try {
      if (arr.length < 1) return arr
      for (let i = 0; i < arr.length; i++) {
        Vue.set(arr, i, { ...arr[i], index: i + 1 })
      }
      return arr
    } catch (e) {
      return arr
    }
  },
  checkPopAge(pop) {

  },
  getChadelHouseDesc(code) {
    try {
      code = Number(code)
      code %= 100
    } catch (err) {
      console.log(err)
      return code
    }
    switch (code) {
      case 0: return 'จำหน่ายบ้าน' // 3000, 3100
      case 11: return 'แก้บ้านเลขที่' // 4011, 4111
      case 12: return 'แก้รหัสตรอก' // '4012, 4112
      case 13: return 'แก้รหัสซอย' // '4013, 4113
      case 14: return 'แก้รหัสถนน' // '4014, 4114
      case 15: return 'แก้รหัสจังหวัดอำเภอตำบลหมู่ที่' // '4015, 4115

      case 21: return 'แก้ชื่อหมู่บ้านจัดสรร' // '4021, 4121
      case 22: return 'แก้ชื่ออาคาร' // '4022, 4122
      case 23: return 'แก้รหัสประเภทบ้าน' // '4023, 4123
      case 24: return 'แก้ฝั่งที่ตั้งของบ้าน' // '4124

      case 31: return 'แก้ลักษณะบ้าน' // '4031, 4131
      case 32: return 'แก้ขนาดของบ้าน' // '4032, 4132
      case 33: return 'แก้จำนวนพื้นที่อยู่อาศัยตาม พรบ.สาธารณสุข' // '4033, 4133
      case 34: return 'แก้รหัสประเภทเอกสารการถือครองที่ดิน' // '4034, 4134
      case 35: return 'แก้เลขที่เอกสารการถือครองที่ดิน' // '4035, 4135
      case 36: return 'แก้ขนาดของพื้นที่ที่ถือครอง' // '4036, 4136
      case 37: return 'แก้เลขที่หนังสืออนุญาติให้ปลูกสร้างบ้าน' // '4137
      case 38: return 'แก้ไขจำนวนชั้น' // '4038, 4138
      case 39: return 'แก้ไขจำนวนห้อง' // '4039, 4139
      case 40: return 'แก้ไขวัสดุของบ้าน' // '4040, 4140
      case 41: return 'แก้เลขรหัสประจำบ้าน' // '4141

      case 51: return 'แก้รหัสสำนักทะเบียน' //  '4151
      case 52: return 'แก้ปีเดือนวันที่เพิ่มทะเบียนบ้าน' // '4152
      case 53: return 'แก้ปีเดือนวันที่ถูกจำหน่าย' // '4153
      case 54: return 'ระบุการพิมพ์ทะเบียนบ้านว่าพิมพ์เมื่อไหร่' // '4154
      case 55: return 'แก้รหัสสำนักทะเบียนรอง' //  '4155
      case 61: return 'แก้รหัสสถานประกอบการกรณีเป็นร้านค้า' // '4161
      case 62: return 'แก้รหัสชุมชน' // '4162
      case 63: return 'แก้รหัสไปรษณีย์' // '4163
      case 64: return 'แก้หมายเลขโทรศัพท์' // '4164
      case 71: return 'แก้ชื่อหมู่บ้านจัดสรร' // '4171
      case 72: return 'แก้รหัสชุมชน' // '4172
      case 73: return 'แก้รหัสไปรษณีย์' // '4173
      default: return code
    }
  },
  docNoFilter(docNo, doc) {
    try {
      if (doc == 10 || doc == 100 || doc == 20 || doc == 30) {
        if (Number(docNo) === 0) {
          return '-'
        }
      }
    } catch (e) {
      return docNo
    }
    return docNo
  },
  async getRcodeDesc(rcode) {
    try {
      const response = await axios.get(`/api/tabdb/rcode/v1/${rcode}`)
      if (response.status === 200) {
        console.log(response.data.description.thai)
        return response.data.description.thai
      }
    } catch (e) {
      console.log(e)
    }
    return rcode
  },
  cutString(str, char) {
    const index = str.indexOf(char)
    const front = str.substring(0, index)
    const back = str.substring(index + 1)
    return { front, back }
  },
  requestSort(arr) {
    // console.log('start')
    // console.log(arr)
    try {
      if (arr.length < 1) return arr
      for (let i = 0; i < arr.length; i += 1) {
        Vue.set(arr, i, { ...arr[i], reqNo: Number(`${arr[i].year}${(arr[i].no + 1000000)}`) })
      }
      arr.sort((a, b) => { return b.reqNo - a.reqNo })
      // console.log('SORT')
      // console.log(arr)
      return arr
    } catch (e) {
      return arr
    }
    // function compare(a, b) {
    //   const year1 = a.year;
    //   const year2 = b.year;
    //   let comparison = 0;
    //   if (year1 > year2) {
    //     comparison = 1;
    //   } else if (year1 < year2) {
    //     comparison = -1;
    //   }
    //   return comparison;
    // }
    // arr.sort(compare)
    // console.log('arr')
    // console.log(arr)
    // // arr = this.noSort(arr)
    // return arr
  },
}
