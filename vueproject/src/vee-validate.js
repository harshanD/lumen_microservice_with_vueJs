import {required, confirmed, length, email,integer,digits,between} from "vee-validate/dist/rules";
import {extend} from "vee-validate";

extend("required", {
  ...required,
  message: "This field is required"
});

extend("email", {
  ...email,
  message: "This field must be a valid email"
});

extend("confirmed", {
  ...confirmed,
  message: "This field confirmation does not match"
});

extend("length", {
  ...length,
  message: "This field must have 2 options"
});

extend("integer", {
  ...integer,
  message: "This field must be a integer"
});
extend("digits", {
  ...digits,
  message: "This field must be a digits"
});
extend("between", {
  ...between,
  message: "This field value isn't normal"
});
