window.isEmptyString = str => {
  str = String(str);
  return (str === "" || !str || str.length < 1);
}