import Vue from 'vue';
import Main from './message.vue';
import {isObject,isVNode} from '@/lib/types'
let Message = Vue.extend(Main);
let instance;
var message = function (options) {
    if (Vue.prototype.$isServer) return;
    if(!instance){
        instance = new Message({
            data: {
                ...options               
            },
         
        });
        instance.$mount();
    }
    instance.destroy=()=>{
        document.body.removeChild(instance.$el);
        instance&&instance.$destroy()
        instance=null
        return null
    }
    instance.init(options)
    document.body.appendChild(instance.$el);
    return instance;
};
['success', 'warning', 'info', 'error'].forEach(type => {
    message[type] = (options) => {
      if (isObject(options) && !isVNode(options)) {
        return message({
          ...options,
          type
        });
      }
      return message({
        type,
        text: options
      });
    };
  });

export default message;