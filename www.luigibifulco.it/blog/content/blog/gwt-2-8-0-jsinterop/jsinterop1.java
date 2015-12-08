package it.luigibifulco;

@JsType
public class MyJsType {
  public boolean bool = true;

  public MyJsType(boolean bool) {
    this.bool = bool;
  }

  public String aPublicMethod() {
    return "Hello ";
  }

  public static String aStaticMethd() {
    return "What's the meaning of life?";
  }
}
