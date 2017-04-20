import org.apache.commons.codec.binary.Base64;
import java.security.KeyFactory;
import java.security.PrivateKey;
import java.security.Signature;
import java.security.spec.PKCS8EncodedKeySpec;

public class SHA256WithRSAAlgo {
    private static String consumerId = "b68d2a72....";   // Trimmed for security reason
    private static String baseUrl = "https://marketplace.walmartapis.com/v2/feeds";
    private static String privateEncodedStr = "MIICeAIBADANBgkqhkiG9w0BAQEFAA......";       //Trimmed for security reasons
    public static void main(String[] args) {
        String httpMethod = "GET";
        String timestamp = String.valueOf(System.currentTimeMillis());
        String stringToSign = consumerId + "\n" +
                                baseUrl + "\n" +
                                httpMethod + "\n" +
                                timestamp + "\n";
        String signedString = SHA256WithRSAAlgo.signData(stringToSign, privateEncodedStr);
        System.out.println("Signed String: " + signedString);
    }
    public static String signData(String stringToBeSigned, String encodedPrivateKey) {
        String signatureString = null;
        try {
            byte[] encodedKeyBytes = Base64.decodeBase64(encodedPrivateKey);
            PKCS8EncodedKeySpec privSpec = new PKCS8EncodedKeySpec(encodedKeyBytes);
            KeyFactory kf = KeyFactory.getInstance("RSA");
            PrivateKey myPrivateKey = kf.generatePrivate(privSpec);
            Signature signature = Signature.getInstance("SHA256withRSA");
            signature.initSign(myPrivateKey);
            byte[] data = stringToBeSigned.getBytes("UTF-8");
            signature.update(data);
            byte[] signedBytes = signature.sign();
            signatureString = Base64.encodeBase64String(signedBytes);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return signatureString;
    }
}