import React from 'react';
alert('Hello from JSX!');
export default function (props) {
  return /*#__PURE__*/React.createElement("div", null, "Hello ", props.fullName);
}