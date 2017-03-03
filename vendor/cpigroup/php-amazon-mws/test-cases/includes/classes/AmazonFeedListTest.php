<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-12 at 13:17:14.
 */
class AmazonFeedListTest extends PHPUnit_Framework_TestCase {

    /**
     * @var AmazonFeedList
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        resetLog();
        $this->object = new AmazonFeedList('testStore', true, null, __DIR__.'/../../test-config.php');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testSetUseToken(){
        $this->assertNull($this->object->setUseToken());
        $this->assertNull($this->object->setUseToken(true));
        $this->assertNull($this->object->setUseToken(false));
        $this->assertFalse($this->object->setUseToken('wrong'));
    }
    
    public function testSetFeedIds(){
        $ok = $this->object->setFeedIds('string1');
        $this->assertNull($ok);
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('FeedSubmissionIdList.Id.1',$o);
        $this->assertEquals('string1',$o['FeedSubmissionIdList.Id.1']);
        $ok2 = $this->object->setFeedIds(array('string1','string2'));
        $this->assertNull($ok2);
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('FeedSubmissionIdList.Id.1',$o2);
        $this->assertArrayHasKey('FeedSubmissionIdList.Id.2',$o2);
        $this->assertEquals('string1',$o2['FeedSubmissionIdList.Id.1']);
        $this->assertEquals('string2',$o2['FeedSubmissionIdList.Id.2']);
        $this->object->setFeedIds('stringx');
        $o3 = $this->object->getOptions();
        $this->assertArrayNotHasKey('FeedSubmissionIdList.Id.2',$o3);
        $this->assertFalse($this->object->setFeedIds(null));
    }
    
    public function testSetTypes(){
        $ok = $this->object->setFeedTypes('string1');
        $this->assertNull($ok);
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('FeedTypeList.Type.1',$o);
        $this->assertEquals('string1',$o['FeedTypeList.Type.1']);
        $ok2 = $this->object->setFeedTypes(array('string1','string2'));
        $this->assertNull($ok2);
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('FeedTypeList.Type.1',$o2);
        $this->assertArrayHasKey('FeedTypeList.Type.2',$o2);
        $this->assertEquals('string1',$o2['FeedTypeList.Type.1']);
        $this->assertEquals('string2',$o2['FeedTypeList.Type.2']);
        $this->object->setFeedTypes('stringx');
        $o3 = $this->object->getOptions();
        $this->assertArrayNotHasKey('FeedTypeList.Type.2',$o3);
        $this->assertFalse($this->object->setFeedTypes(null));
    }
    
    public function testSetStatuses(){
        $ok = $this->object->setFeedStatuses('string1');
        $this->assertNull($ok);
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('FeedProcessingStatusList.Status.1',$o);
        $this->assertEquals('string1',$o['FeedProcessingStatusList.Status.1']);
        $ok2 = $this->object->setFeedStatuses(array('string1','string2'));
        $this->assertNull($ok2);
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('FeedProcessingStatusList.Status.1',$o2);
        $this->assertArrayHasKey('FeedProcessingStatusList.Status.2',$o2);
        $this->assertEquals('string1',$o2['FeedProcessingStatusList.Status.1']);
        $this->assertEquals('string2',$o2['FeedProcessingStatusList.Status.2']);
        $this->object->setFeedStatuses('stringx');
        $o3 = $this->object->getOptions();
        $this->assertArrayNotHasKey('FeedProcessingStatusList.Status.2',$o3);
        $this->assertFalse($this->object->setFeedStatuses(null));
    }
    
    public function testSetMaxCount(){
        $this->assertFalse($this->object->setMaxCount(null)); //can't be nothing
        $this->assertFalse($this->object->setMaxCount('NaN')); //can't be a string
        $this->assertFalse($this->object->setMaxCount(-5)); //can't be negative
        $this->assertFalse($this->object->setMaxCount(105)); //can't be over 100
        $this->assertNull($this->object->setMaxCount(5));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('MaxCount',$o);
        $this->assertEquals('5',$o['MaxCount']);
    }
    
    /**
    * @return array
    */
    public function timeProvider() {
        return array(
            array(null, null, false, false), //nothing given, so no change
            array(true, true, false, false), //not strings or numbers
            array('', '', false, false), //strings, but empty
            array('-1 min', null, true, false), //one set
            array(null, '-1 min', false, true), //other set
            array('-1 min', '-1 min', true, true), //both set
        );
    }
    
    /**
     * @dataProvider timeProvider
     */
    public function testSetTimeLimits($a, $b, $c, $d){
        $this->object->setTimeLimits($a,$b);
        $o = $this->object->getOptions();
        if ($c){
            $this->assertArrayHasKey('SubmittedFromDate',$o);
            $this->assertStringMatchesFormat('%d-%d-%dT%d:%d:%d%i',$o['SubmittedFromDate']);
        } else {
            $this->assertArrayNotHasKey('SubmittedFromDate',$o);
        }
        
        if ($d){
            $this->assertArrayHasKey('SubmittedToDate',$o);
            $this->assertStringMatchesFormat('%d-%d-%dT%d:%d:%d%i',$o['SubmittedToDate']);
        } else {
            $this->assertArrayNotHasKey('SubmittedToDate',$o);
        }
    }
    
    public function testResetTimeLimit(){
        $this->object->setTimeLimits('-1 min','-1 min');
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('SubmittedFromDate',$o);
        $this->assertArrayHasKey('SubmittedToDate',$o);
        
        $this->object->resetTimeLimits();
        $check = $this->object->getOptions();
        $this->assertArrayNotHasKey('SubmittedFromDate',$check);
        $this->assertArrayNotHasKey('SubmittedToDate',$check);
    }
    
    public function testFetchFeedSubmissions(){
        resetLog();
        $this->object->setMock(true,'fetchFeedSubmissions.xml'); //no token
        $ok = $this->object->fetchFeedSubmissions();
        $this->assertNull($ok);
        
        $check = parseLog();
        $this->assertEquals('Single Mock File set: fetchFeedSubmissions.xml',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/fetchFeedSubmissions.xml',$check[2]);
        
        $o = $this->object->getOptions();
        $this->assertEquals('GetFeedSubmissionList',$o['Action']);
        
        $r = $this->object->getFeedList();
        $this->assertArrayHasKey(0,$r);
        $this->assertEquals('1234567890',$r[0]['FeedSubmissionId']);
        $this->assertEquals('_MOCK_FEED_',$r[0]['FeedType']);
        $this->assertEquals('2012-12-12T12:12:12+00:00',$r[0]['SubmittedDate']);
        $this->assertEquals('_SUBMITTED_',$r[0]['FeedProcessingStatus']);
        $this->assertEquals('2012-12-15T12:12:12+00:00',$r[0]['StartedProcessingDate']);
        $this->assertEquals('2012-12-16T12:12:12+00:00',$r[0]['CompletedProcessingDate']);
        
        $this->assertFalse($this->object->hasToken());
        
        return $this->object;
    }
    
    /**
     * @param AmazonFeedList $o
     * @depends testFetchFeedSubmissions
     */
    public function testGetFeedInfo($o){
        $list = $o->getFeedList();
        $this->assertInternalType('array',$list);
        $this->assertArrayHasKey(0,$list);
        
        $info = $o->getFeedInfo();
        $this->assertInternalType('array',$info);
        $this->assertArrayHasKey('FeedSubmissionId',$info);
        $this->assertArrayHasKey('FeedType',$info);
        $this->assertArrayHasKey('SubmittedDate',$info);
        $this->assertArrayHasKey('FeedProcessingStatus',$info);
        $this->assertArrayHasKey('StartedProcessingDate',$info);
        $this->assertArrayHasKey('CompletedProcessingDate',$info);
        
        $id = $o->getFeedId();
        $type = $o->getFeedType();
        $date = $o->getDateSubmitted();
        $status = $o->getFeedStatus();
        
        $this->assertEquals($list[0],$info);
        $this->assertEquals($info['FeedSubmissionId'],$id);
        $this->assertEquals($info['FeedType'],$type);
        $this->assertEquals($info['SubmittedDate'],$date);
        $this->assertEquals($info['FeedProcessingStatus'],$status);
        $this->assertEquals($info['StartedProcessingDate'], $o->getDateStarted());
        $this->assertEquals($info['CompletedProcessingDate'],$o->getDateCompleted());
        
        $this->assertFalse($o->getFeedInfo(null));
        $this->assertFalse($o->getFeedId(null));
        $this->assertFalse($o->getFeedType(null));
        $this->assertFalse($o->getDateSubmitted(null));
        $this->assertFalse($o->getFeedStatus(null));
        $this->assertFalse($o->getDateStarted(null));
        $this->assertFalse($o->getDateCompleted(null));
        $this->assertFalse($o->getFeedInfo('string'));
        $this->assertFalse($o->getFeedId('string'));
        $this->assertFalse($o->getFeedType('string'));
        $this->assertFalse($o->getDateSubmitted('string'));
        $this->assertFalse($o->getFeedStatus('string'));
        $this->assertFalse($o->getDateStarted('string'));
        $this->assertFalse($o->getDateCompleted('string'));
        
        $this->assertFalse($this->object->getFeedList()); //not fetched yet for this object
    }
    
    public function testFetchFeedSubmissionsToken1(){
        resetLog();
        $this->object->setMock(true,array('fetchFeedSubmissionsToken.xml'));
        
        //without using token
        $ok = $this->object->fetchFeedSubmissions();
        $this->assertNull($ok);
        $check = parseLog();
        $this->assertEquals('Mock files array set.',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/fetchFeedSubmissionsToken.xml',$check[2]);
        $this->assertTrue($this->object->hasToken());
        $o = $this->object->getOptions();
        $this->assertEquals('GetFeedSubmissionList',$o['Action']);
        $r = $this->object->getFeedList();
        $this->assertArrayHasKey(0,$r);
        $this->assertEquals('9876543210',$r[0]['FeedSubmissionId']);
        $this->assertEquals('_MOCK_FEED_',$r[0]['FeedType']);
        $this->assertEquals('2012-12-12T12:12:12+00:00',$r[0]['SubmittedDate']);
        $this->assertEquals('_SUBMITTED_',$r[0]['FeedProcessingStatus']);
    }
    
    public function testFetchFeedSubmissionsToken2(){
        resetLog();
        $this->object->setMock(true,array('fetchFeedSubmissionsToken.xml','fetchFeedSubmissionsToken2.xml'));
        
        //with using token
        $this->object->setUseToken();
        $ok = $this->object->fetchFeedSubmissions();
        $this->assertNull($ok);
        $check = parseLog();
        $this->assertEquals('Mock files array set.',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/fetchFeedSubmissionsToken.xml',$check[2]);
        $this->assertEquals('Recursively fetching more Feeds',$check[3]);
        $this->assertEquals('Fetched Mock File: mock/fetchFeedSubmissionsToken2.xml',$check[4]);
        $this->assertFalse($this->object->hasToken());
        $o = $this->object->getOptions();
        $this->assertEquals('GetFeedSubmissionListByNextToken',$o['Action']);
        $r = $this->object->getFeedList();
        $this->assertArrayHasKey(0,$r);
        $this->assertEquals('9876543210',$r[0]['FeedSubmissionId']);
        $this->assertEquals('_MOCK_FEED_',$r[0]['FeedType']);
        $this->assertEquals('2012-12-12T12:12:12+00:00',$r[0]['SubmittedDate']);
        $this->assertEquals('_SUBMITTED_',$r[0]['FeedProcessingStatus']);
        $this->assertEquals('1234567890',$r[1]['FeedSubmissionId']);
        $this->assertEquals('_MOCK_FEED_',$r[1]['FeedType']);
        $this->assertEquals('2012-12-12T12:12:12+00:00',$r[1]['SubmittedDate']);
        $this->assertEquals('_SUBMITTED_',$r[1]['FeedProcessingStatus']);
        
        
    }
    
    public function testCountFeeds(){
        resetLog();
        $this->object->setMock(true,'countFeeds.xml');
        $this->assertFalse($this->object->getFeedCount()); //not fetched yet
        $ok = $this->object->countFeeds();
        $this->assertNull($ok);
        
        $check = parseLog();
        $this->assertEquals('Single Mock File set: countFeeds.xml',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/countFeeds.xml',$check[2]);
        
        $o = $this->object->getOptions();
        $this->assertEquals('GetFeedSubmissionCount',$o['Action']);
        
        $count = $this->object->getFeedCount();
        $this->assertEquals('463',$count);
    }
    
    public function testCancelFeeds(){
        resetLog();
        $this->object->setMock(true,'cancelFeeds.xml');
        $this->assertFalse($this->object->getFeedCount()); //not fetched yet
        $ok = $this->object->cancelFeeds();
        $this->assertNull($ok);
        
        $check = parseLog();
        $this->assertEquals('Single Mock File set: cancelFeeds.xml',$check[1]);
        $this->assertEquals('Fetched Mock File: mock/cancelFeeds.xml',$check[2]);
        $this->assertEquals('Successfully cancelled 1 report requests.',$check[3]);
        
        $o = $this->object->getOptions();
        $this->assertEquals('CancelFeedSubmissions',$o['Action']);
        
        $count = $this->object->getFeedCount();
        $this->assertEquals('1',$count);
    }
    
}

require_once('helperFunctions.php');
